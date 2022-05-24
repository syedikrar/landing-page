<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    const APPROVED = 'approved';
    const DISAPPROVED = 'disapproved';
    const STATUS = [
        'approved' => self::APPROVED,
        'disapproved' => self::DISAPPROVED,
    ];

    protected $fillable = [
        'name',
        'designation',
        'description',
        'user_id',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
