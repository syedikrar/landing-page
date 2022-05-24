<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $appends = ['options'];
    

    protected $fillable = [
        'form_section_id',
        'type',
        'label',
        'hide_label',
        'attribute_name',
        'placeholder',
        'validation_rule',
        'valid_input',
        'all_valid',
        'valid_date_from',
        'valid_date_to',
        'required',
        'default_value'
    ];

    public function options(){
        return $this->hasMany(FormFieldOption::class);
    }
    function getOptionsAttribute() {
        return $this->options()->get();
    }
}
