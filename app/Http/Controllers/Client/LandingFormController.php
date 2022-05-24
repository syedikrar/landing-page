<?php

namespace App\Http\Controllers\Client;

use App\Models\Form;
use Inertia\Inertia;
use App\Models\Landing;
use App\Models\FormField;
use App\Models\FormHeader;
use App\Models\FormSection;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\FormFieldOption;
use App\Models\PredefinedField;
use App\Models\AcceptenceCriteria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;



class LandingFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = Form::findOrFail($id);
        $predefinedFields = PredefinedField::all();
        return Inertia::render('LandingForms/Create',[
            'form' => $form,
            'landing' => $form->landing,
            'sections' => $form->sections,
            'headers' => $form->headers,
            'predefinedFields' => $predefinedFields,
            'url' => $form->landing->uuid . '.' . env('DOMAIN_URL'),
            'criteria' => AcceptenceCriteria::where('form_id', $id)->paginate(3)->through(fn ($criteria) => [
                'id' => $criteria->id,
                'name' => $criteria->name,
                'leading_status' => $criteria->leading_status,
                'match_type' => $criteria->match_type,
                'forwarding_status' => $criteria->forwarding_status,
                'response' => $criteria->response
            ])
        ]);
    }

   
    public function edit($id)
    {
       
    }

   
    public function update(Request $request, $id)
    {  

      
        $formData = $request->all();
        $form = Form::findOrFail($id);
        $form->update([
            'title'=>$formData['title'],
            'submission_link'=>$formData['submission_link'],
            'method'=>$formData['submission_method'],
            'data_type'=>$formData['data_type'],
            'btn_text'=>$formData['btn_text'],
            'btn_bg_color'=>$formData['btn_bg_color'],
            'btn_color'=>$formData['btn_color'],
        ]);
        $form->headers()->delete();
        foreach($formData['headers'] as $header){
            FormHeader::create([
                'form_id' => $form->id,
                'key'=>$header['key'],
                'value'=>$header['value']
            ]);
        }
        $form->sections()->delete();
        foreach($formData['sections'] as $section){
            $newSection = FormSection::create([
                'title'=>$section['title'],
                'hide_title'=>$section['hide_title'] ? 1: 0,
                'form_id'=>$id,
            ]);

            foreach($section['fields'] as $field){
                $formField = FormField::create([
                    'form_section_id'=>$newSection->id,
                    'label'=>$field['label'],
                    'hide_label'=>$field['hideLabel'] ? 1: 0,
                    'type'=>$field['type'],
                    'placeholder'=>$field['placeholder'],
                    'default_value'=>$field['defaultValue'],
                    'required'=>$field['required'] ? 1: 0,
                    'attribute_name'=>$field['nameAttribute'],
                    'validation_rule'=>$field['validationRule'],
                    'valid_input'=>$field['validInput'],
                    'all_valid'=>$field['allValid'],
                    'valid_date_from'=>$field['validDateFrom'],
                    'valid_date_to'=>$field['validDateTo'],
                ]);

                if(Arr::exists($field, 'options')){
                    foreach($field['options'] as $option){
                        FormFieldOption::create([
                            'form_field_id'=>$formField->id,
                            'value'=>$option['value'],
                            'valid'=>$option['valid'] ? 1: 0,
                        ]);
                    }
                }
                if(Arr::exists($field, 'csv') && $field['csv']){
                    $file = $this->csvToArray($field['csv']);
                
                    foreach($file as $option){
                    foreach($option as $op){
                        FormFieldOption::create([
                            'form_field_id'=>$formField->id,
                            'value'=>$op,
                        ]);
                    }
                }

                }
            }
        }
       
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function testResponse(Request $request){
        $form = $request->all();
        
        $headers =[];
        foreach($request->input('headers') as $header){
            $headers[$header['key']]=$header['value'];
        }
        $inputs = [];
        foreach($form['sections'] as $section){
            foreach($section["fields"] as $field)
            $inputs[$field['nameAttribute']]= $field['defaultValue'] ??  'test '.$field['nameAttribute'].' value';
        }
        
        $response=null;
        try {
            switch ($form['method']) {
                case "POST":
                    if($form['data_type'] =='json'){
                        $response = Http::withHeaders($headers)->post($form['link'],$inputs); 
                    
                    }
                    if($form['data_type'] =='form'){
                        $response = Http::asForm()->withHeaders($headers)->post($form['link'],$inputs); 
                        
                    }
                   
                    break;
                case "GET":
                    if($form['data_type'] =='json'){
                    $response = Http::withHeaders($headers)->get($form['link'],$inputs);
                    
                    }
                    if($form['data_type'] =='form'){
                        $response = Http::asForm()->withHeaders($headers)->get($form['link'],$inputs);
                        
                    }
                  
                    break;
                default:
            }
            if($response->failed() || $response->clientError() || $response->serverError()){
                return ['status'=>'failed','message'=>'Request faild with status code '.$response->status(),'response'=>$response->json()];
            }
            
            if($response->successful() || $response->ok()){
                return ['status'=>'success','message'=>'Request sent successfully','response'=>$response->json()];
            }
                            
        } catch (\Exception $e)
        {
            return ['response'=>'failed','message'=>'Request faild with status code 500'];
        }
                
            
        
    }
}
