<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Beat extends Model implements HasMedia
{
    use HasFactory;

    use HasUlids;

    use InteractsWithMedia;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('audio')
            ->singleFile()
            ->acceptsMimeTypes(['audio/mpeg', 'audio/wav'])
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('preview')
                    ->performOnCollections('audio')
                ;
            });

        $this
            ->addMediaCollection('cover_art')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->nonQueued();
            });
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($beat) {
            $beat->slug = Str::slug($beat->title) . '-' . Str::lower(Str::random(6));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beatFile()
    {
        return $this->hasOne(BeatFile::class);
    }

    public function stats()
    {
        return $this->hasOne(BeatStats::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }
}
