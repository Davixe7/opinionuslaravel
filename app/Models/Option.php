<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Option extends Model implements HasMedia
{
    protected $guarded = [];
    use HasFactory, InteractsWithMedia;

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function votes(){
        return $this->hasMany(Vote::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232)
              ->sharpen(10);

        $this->addMediaConversion('optimized')
              ->quality(80)
              ->optimize();
    }
}
