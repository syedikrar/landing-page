<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingThankYouPageData extends Model
{
    use HasFactory;

    protected $fillable = [
        'landing_id',
        'html_data',
        'styles_data',
        'css_data',
        'assets_data',
    ];

    public function landing(){
        return $this->belongsTo(Landing::class);

    }

}
