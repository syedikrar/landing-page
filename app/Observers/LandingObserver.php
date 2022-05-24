<?php

namespace App\Observers;

use App\Models\Form;
use App\Models\Landing;
use App\Models\FormField;
use App\Models\FormHeader;
use App\Models\FormSection;
use Illuminate\Support\Arr;
use App\Models\AcceptenceCriteria;

class LandingObserver
{
    /**
     * Handle the Landing "created" event.
     *
     * @param  \App\Models\Landing  $landing
     * @return void
     */
    public function created(Landing $landing)
    {
        $form = Form::create([
            'landing_id'=>$landing->id,
            'title'=>'Register',
            'submission_link'=>'#',
            'method'=>'POST',
            'data_type'=>'json'
        ]);
        $section = FormSection::create([
            'title'=> "Basic Information",
            'hide_title'=>1,
            'form_id'=>$landing->form_id,
        ]);
        $fields = [
            [
                "form_section_id"=>$section->id,
                "type" => "text",
                "label" => "Name",
                "hide_label" => 1,
                "placeholder" => "Name",
                "attribute_name" => "name",
                "required" => 1,
                "component" => null,
                "validation_rule" => "contains",
                "valid_input" => null,
                "all_valid" => 1,
                "valid_date_from" => null,
                "valid_date_to" => null,
            ],
            [
                "form_section_id"=>$section->id,
                "type" => "text",
                "label" => "Email",
                "hide_label" => 1,
                "placeholder" => "Email",
                "attribute_name" => "email",
                "required" => 1,
                "component" => null,
                "validation_rule" => "contains",
                "valid_input" => null,
                "all_valid" => 1,
                "valid_date_from" => null,
                "valid_date_to" => null,
            ],
            [
                "form_section_id"=>$section->id,
                "type" => "text",
                "label" => "Phone",
                "hide_label" => 1,
                "placeholder" => "Phone",
                "attribute_name" => "phone",
                "required" => 1,
                "component" => null,
                "validation_rule" => "contains",
                "valid_input" => null,
                "all_valid" => 1,
                "valid_date_from" => null,
                "valid_date_to" => null,
            ]
        ];
        foreach($fields as $field){
            $formField = FormField::create($field);
        }
         $names = ['Successfull Response', 'Failed Reponse', 'Unauthenticated Response'];
        $leading_statuses = ['accepted', 'rejected', 'unauthenticated'];
        $match_type = ['Response Body', 'Response Code', 'Other'];
        $forwarding_status = ['success', 'fail', 'unauthenticated'];
        for($i = 0; $i <count($names);$i++){
            AcceptenceCriteria::create([
                'name' => $names[$i],
                'leading_status' => $leading_statuses[$i],
                'match_type' => $match_type[$i],
                'forwarding_status' => $forwarding_status[$i],
                'form_id' => $form->id,
            ]);
        }
    }

    /**
     * Handle the Landing "updated" event.
     *
     * @param  \App\Models\Landing  $landing
     * @return void
     */
    public function updated(Landing $landing)
    {
        //
    }

    /**
     * Handle the Landing "deleted" event.
     *
     * @param  \App\Models\Landing  $landing
     * @return void
     */
    public function deleted(Landing $landing)
    {
        //
    }

    /**
     * Handle the Landing "restored" event.
     *
     * @param  \App\Models\Landing  $landing
     * @return void
     */
    public function restored(Landing $landing)
    {
        //
    }

    /**
     * Handle the Landing "force deleted" event.
     *
     * @param  \App\Models\Landing  $landing
     * @return void
     */
    public function forceDeleted(Landing $landing)
    {
        //
    }
}
