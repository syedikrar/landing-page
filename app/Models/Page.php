<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translation;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'heading',
        'description',
        'slug',
        'page_order',
        'is_delete',
        'status',
    ];
    
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translateable');
    }

    public function currentTranslation()
    {
        return $this->morphOne(Translation::class, 'translateable');
    }
}
