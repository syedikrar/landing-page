<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingScript extends Model
{
    use HasFactory;

    protected $fillable = ['landing_id','title','type','value'];

    
}
