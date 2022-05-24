<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    const LANDING_PAGE = 'landing-page';
    const SOCIAL_LINKS = 'social-links';

    protected $fillable = [
        'key',
        'value',
        'type',
    ];
}
