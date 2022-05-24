<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSection extends Model
{
    use HasFactory;

    protected $fillable = ['form_id','title','hide_title'];
    protected $appends = ['fields'];


    function fields() {
        return $this->hasMany(FormField::class);
    }
    
    function getFieldsAttribute() {
        return $this->fields()->get();
    }

}
