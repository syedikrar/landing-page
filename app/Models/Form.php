<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'landing_id', 
        'title', 
        'btn_text',
        'btn_color',
        'btn_bg_color',
        'submission_link', 
        'method',
        'data_type',
        'total_entries',
        'valid_entries'
    ];

    public function landing(){
        return $this->belongsTo(Landing::class);
    }

    public function fields(){
        return $this->hasManyThrough(FormField::class,FormSection::class);
    }
 
    public function sections(){
        return $this->hasMany(FormSection::class);
    }

    public function headers(){
        return $this->hasMany(FormHeader::class);
    }

    public function entries(){
        return $this->hasMany(FormEntry::class);
    }
 
}
