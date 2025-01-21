<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MobileDevice extends Model implements HasMedia
{
    use HasFactory;

    use HasUlids;

    use InteractsWithMedia;

    protected $guarded = ['id'];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function phoneBrand()
    {
        return $this->belongsTo(PhoneBrand::class);
    }

    public function phoneModel()
    {
        return $this->belongsTo(PhoneModel::class);
    }

    public function phoneVariant()
    {
        return $this->belongsTo(PhoneVariant::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->nonQueued();

        $this->addMediaConversion('preview')
            ->width(400)
            ->height(400)
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(800)
            ->height(800)
            ->keepOriginalImageFormat()
            ->optimize()
            ->quality(90)
            ->nonQueued();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($device) {
            if (! $device->slug) {
                $device->slug = Str::slug($device->listing_title);
            }
            if (! $device->listing_code) {
                $device->listing_code = self::generateListingCode();
            }
        });

        static::updating(function ($device) {
            if ($device->isDirty('name') && ! $device->isDirty('slug')) {
                $device->slug = Str::slug($device->listing_title);
            }
        });
    }


    protected static function generateListingCode()
    {
        do {
            $prefix = 'LST';
            $numbers = str_pad(random_int(0, 9999999), 7, '0', STR_PAD_LEFT);

            $code = $prefix . $numbers;
        } while (static::where('listing_code', $code)->exists());

        return $code;
    }
}
