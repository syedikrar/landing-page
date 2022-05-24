<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormEntry;
use App\Models\Landing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;
use Carbon\Carbon;


class FormController extends Controller
{
    private $baseUrl = "https://vpnapi.io/api/";

    public function submitForm(Request $request, $id)
    {
        
        $params = $request->params;
        // $click_id = $request->click_id;
        $form = Form::findOrFail($id);
        $entry = FormEntry::create([
            'form_id'=>$form->id,
            'landing_id'=>$form->landing->id
        ]);

        $headers = $form->headers()->pluck('value','key')->toArray();
        $request->offsetUnset('_token');
        $request->offsetUnset('params');
        $inputs = $request->input();

        $validLead = true;
        $ip = $this->getIp() == '127.0.0.1' ? '66.102.0.0' : $this->getIp();


        $url = $this->baseUrl . $ip . '?key=' . env('VPN_IP_KEY');
        Log::info("VPN", [
            'IP' => $ip 
        ]);
       
        $vpnValidation = Http::get($url);

        if($this->getIp() != '127.0.0.1'){       

            $validLead = $vpnValidation['security']['vpn'] ? false : true;
            // storing to log
            Log::info("VPN", [
                'message' => $vpnValidation['security']['vpn'] ? 'VPN used' : 'No VPN request'
            ]);
        }       
        if ($validLead) {
            if ($vpnValidation['location']['country_code'] != $form->landing->country->code) {    
                $validLead = false;
                Log::info("Lead Failed", [
                    'message' => 'form country code '.$form->landing->country->code.' user country code '.$vpnValidation['location']['country_code']
                ]);
                
            } else {
                foreach ($inputs as $name => $value ) {         
     
                    $field =  $form->fields()->where('attribute_name',$name)->first(); 

                    if($field->type == 'text'){
                        if($field->validation_rule == "contains" && $field->valid_input!="" && !\Str::contains($value, $field->valid_input)){
                            $validLead = false;
                            Log::info("Lead Failed", [
                                'message' => $field->attribute_name." contains ".$field->valid_input
                            ]);
                        }
                        if($field->validation_rule == "equals to"  && $value != $field->valid_input){
                            $validLead = false;
                            Log::info("Lead Failed", [
                                'message' => $field->attribute_name." equals to ".$field->valid_input
                            ]);
                        }
                    }
        
                    if($field->type == 'select' || $field->type == 'radio'){
                        if(!$field->options()->where('value',$value)->first()->valid){
                            $validLead = false;
                            Log::info("Lead Failed", [
                                'message' => $field->attribute_name." option ".$value
                            ]);
                        }
                    }

                    if($field->type == 'checkbox' ){
                        $valiCheck = false;
                        foreach($value as $checked){
                            if($field->options()->where('value',$checked)->first()->valid){
                                $valiCheck = true;
                            }
                        }
                        if(!$valiCheck){
                            $validLead = false;
                            Log::info("Lead Failed", [
                                'message' => $field->attribute_name." checkbox ".$value
                            ]);
                        }            
                    }
                    if($field->type == 'date' && $value){

                       if(!$field->all_valid){
                        $validLead = Carbon::createFromFormat('Y-m-d', $value)->between(
                                            Carbon::createFromFormat('Y-m-d', $field->valid_date_to),
                                            Carbon::createFromFormat('Y-m-d',$field->valid_date_from)
                                        );
                       }
                    }
                }
            }
        }
        $inputs['ip'] = $ip;
        $inputs['timestamp'] = Carbon::now()->format('Y-m-d H:i:s');

        if($validLead){
            $entry->update([
                'valid'=>true,
            ]);
            $response=null;
            switch ($form->method) {
                case "POST":
                    if($form->data_type =='json'){
                        $response = Http::withHeaders($headers)->post($form->submission_link, $inputs);
                    }
                    if($form->data_type =='form'){
                        $response = Http::asForm()->withHeaders($headers)->post($form->submission_link, $inputs);
                    }
                break;
                case "GET":
                    if($form->data_type =='json'){
                        $response = Http::withHeaders($headers)->get($form->submission_link, $inputs);  
                    }
                    if($form->data_type =='form'){
                        $response = Http::asForm()->withHeaders($headers)->get($form->submission_link, $inputs);
                    }
                break;
                default:
            }
            if($response->failed() || $response->clientError() || $response->serverError()){
                $entry->update([
                    'api_response_error'=>true,
                ]);
            }
            Log::info("Response", [
                'message' => $response
            ]);
        }    
        return redirect()->route('thankyou',$form->landing->uuid)->with( ['params' => $params,'lead_id'=>$entry->id] );        
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }

    public function thankYou($uuid){

        $landing = Landing::whereUuid($uuid)->firstOrFail();
        $queryParams = \Session::get('params');
        $params= array();
        if($queryParams){
            foreach($queryParams as $param => $value){
                if($landing->params()->where('key',$param)->first()){
                    $params[$param] = $value;
                }
            }
        }  
        

        $staticParams = $landing->staticParams;
       
        if($staticParams){
            foreach($staticParams as $param){
                $params[$param->key] = $param->value;
            }
        } 
        $url = $landing->pixel.'?order_id='.\Session::get('lead_id');
        foreach($params as $param => $value){
            $url.='&'.$param.'='.$value;
        }
        $params['order_id'] = \Session::get('lead_id'); 
        $response = Http::post($url , $params);
        $pageData = $landing->thankYouPageData;
        
        return view('thankyou',compact('pageData','landing','params','response'));
    }
}
