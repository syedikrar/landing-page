<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'password',
        'status',
        'user_type',
        'rejection_reason'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company(){
        return $this->hasOne(Company::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function testimonial()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function landings(){
        return $this->hasManyThrough(Landing::class, Campaign::class);
    }

    public function card()
    {
        return $this->hasOne(UserCard::class);
    }
}
