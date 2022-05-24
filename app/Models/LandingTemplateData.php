<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingTemplateData extends Model
{
    use HasFactory;

    protected $fillable = [
        'landing_id',
        'html_data',
        'styles_data',
        'css_data',
        'assets_data',
    ];


    public function campaign(){
        return $this->belongsTo(Campaign::class);

    }
    public function landing(){
        return $this->belongsTo(Landing::class);

    }
    public function template(){
        return $this->belongsTo(Template::class);

    }

}
