<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredefinedField extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $appends = ['options'];
    

    protected $fillable = [
        'type',
        'label',
        'attribute_name',
        'placeholder',
        'validation_rule',
        'valid_input',
        'required'
    ];

    public function options(){
        return $this->hasMany(PredefinedFieldOption::class);
    }
    function getOptionsAttribute() {
        return $this->options()->get();
      }
}
