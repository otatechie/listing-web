<?php

namespace App\Models;

use App\Models\Beat;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BeatFile extends Model implements HasMedia
{
    use HasFactory;

    use HasUlids;

    use InteractsWithMedia;

    protected $guarded = ['id'];

    protected $with = ['media'];

    public function beat()
    {
        return $this->belongsTo(Beat::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('audio')
            ->singleFile()
            ->acceptsMimeTypes(['audio/mpeg', 'audio/wav']);

        $this
            ->addMediaCollection('cover_art')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('large')
                    ->width(800)
                    ->height(800)
                    ->keepOriginalImageFormat()
                    ->optimize()
                    ->quality(90)
                    ->nonQueued();
                $this
                    ->addMediaConversion('medium')
                    ->width(400)
                    ->height(400)
                    ->nonQueued();
                $this
                    ->addMediaConversion('preview')
                    ->width(200)
                    ->height(200)
                    ->nonQueued();
            });
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($beatFile) {
            $beatFile->beat->stats()->create([
                'plays_count' => 0,
                'likes_count' => 0,
                'downloads_count' => 0,
            ]);
        });
    }
}
