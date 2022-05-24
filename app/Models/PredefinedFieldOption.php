<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredefinedFieldOption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'predefined_field_id',
        'value',
        'valid',
    ];

    public function field(){
        return $this->belongsTo(PredefinedField::class);
    }
}
