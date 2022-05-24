<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptenceCriteria extends Model
{
    use HasFactory;
    protected $table = 'acceptence_criteria';
    protected $fillable = [
        'form_id',
        'name',
        'leading_status',
        'match_type',
        'forwarding_status',
        'response'
    ];
}
