<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormHeader extends Model
{
    use HasFactory;

    protected $fillable = ['form_id','key','value'];


    public function form(){
        return $this->belongsTo(Form::class);
    }
}
