<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingParam extends Model
{
    use HasFactory;

    protected $fillable = ['landing_id','key','value','type'];

}
