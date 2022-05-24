<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PredefinedField;
use App\Models\PredefinedFieldOption;

class PredefinedFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = [
            ['label'=>'First Name', 
            'type'=>'text',
            'attribute_name'=>'first_name',
            'placeholder'=>'Enter your first name',
            'validation_rule'=>'contains',
            'valid_input'=>'',
            'required'=>1,
            'options'=>[]
            ],
            ['label'=>'Last Name', 
            'type'=>'text',
            'attribute_name'=>'last_name',
            'placeholder'=>'Enter your last name',
            'validation_rule'=>'contains',
            'valid_input'=>'',
            'required'=>1,
            'options'=>[]
            ],
            ['label'=>'Email', 
            'type'=>'text',
            'attribute_name'=>'email',
            'placeholder'=>'Enter your email address',
            'validation_rule'=>'contains',
            'valid_input'=>'',
            'required'=>1,
            'options'=>[]
            ],
            ['label'=>'Gender', 
            'type'=>'radio',
            'attribute_name'=>'gender',
            'placeholder'=>'gender',
            'validation_rule'=>'',
            'valid_input'=>'',
            'required'=>1,
            'options'=>[ 
                    ['value'=>'Male','valid'=>1],
                    ['value'=>'Female','valid'=>1],
                    ['value'=>'Other','valid'=>1],
                ],
            ]
        ];

        foreach($fields as $field){
            $formField = PredefinedField::create([
                 'label'=>$field['label'],
                 'type'=>$field['type'],
                 'placeholder'=>$field['placeholder'],
                 'required'=>$field['required'] ? 1: 0,
                 'attribute_name'=>$field['attribute_name'],
                 'validation_rule'=>$field['validation_rule'],
                 'valid_input'=>$field['valid_input'],
            ]);
 
            if($field['options']){
                foreach($field['options'] as $option){
                    PredefinedFieldOption::create([
                         'predefined_field_id'=>$formField->id,
                         'value'=>$option['value'],
                         'valid'=>$option['valid'] ? 1: 0,
                    ]);
                }
            }
        }
    }
}
