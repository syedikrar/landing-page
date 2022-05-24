<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Landing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'campaign_id',
        'country_id',
        'template_id',
        'type',
        'domain',
        'status',
        'uuid',
        'previous_status',
        'rejection_reason'
    ];

    protected $appends = ['google_analytics','pixel','pixel_type','params','form_id'];

    
    /**
     * Scope a query to only include active landings.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function template(){
        return $this->belongsTo(Template::class);
    }

    public function landingTemplateData(){
        return $this->hasOne(LandingTemplateData::class);
    }
    public function thankYouPageData(){
        return $this->hasOne(LandingThankYouPageData::class);
    }
    public function form(){
        return $this->hasOne(Form::class);
    }

    function getPixelAttribute() {
        return $this->hasOne(LandingScript::class)->where('title','pixel')->value('value');
    }
    function getPixelTypeAttribute() {
        return $this->hasOne(LandingScript::class)->where('title','pixel')->value('type');
    }
    function getGoogleAnalyticsAttribute() {
        return $this->hasOne(LandingScript::class)->where('title','google_analytics')->value('value');
    }
    public function params(){
        return $this->hasMany(LandingParam::class)->where('type', 'dynamic');
    }
    function getParamsAttribute() {
        return $this->params()->get();
    }
    public function views(){
        return $this->hasMany(LandingView::class);
    } 
    function getFormIdAttribute() {
        return $this->form->id;
    }

    public function staticParams(){
        return $this->hasMany(LandingParam::class)->where('type', 'static');
    }
}
