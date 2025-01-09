<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PhoneMobileDevice extends Model implements HasMedia
{
    use HasFactory;

    use HasUlids;

    use InteractsWithMedia;

    protected $guarded = ['id'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('images')
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

        static::creating(function ($device) {
            if (! $device->slug) {
                $device->slug = Str::slug($device->listing_title);
            }
        });

        static::updating(function ($device) {
            if ($device->isDirty('name') && ! $device->isDirty('slug')) {
                $device->slug = Str::slug($device->listing_title);
            }
        });
    }
}
