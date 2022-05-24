<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templates = [
            // ['name'=>'Devbook','thumbnail'=>'devbook_thumbnail.png','preview_url'=>'templates/devbook'],
            ['name'=>'Template 1','thumbnail'=>'template1.png','preview_url'=>'templates/template1'],
            ['name'=>'Template 2','thumbnail'=>'template2.png','preview_url'=>'templates/template2'],
            ['name'=>'Template 3','thumbnail'=>'template3.png','preview_url'=>'templates/template3'],

        ];
        foreach($templates as $template){
            Template::UpdateOrcreate($template);
        }
        
    }
}
