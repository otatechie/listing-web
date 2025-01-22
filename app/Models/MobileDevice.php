<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MobileDevice extends Model implements HasMedia
{
    use HasFactory;

    use HasUlids;

    use InteractsWithMedia;

    use Searchable;

    protected $guarded = ['id'];

    protected $appends = ['is_favorited'];


    public function getIsFavoritedAttribute()
    {
        if (!auth()->check()) return false;
        return $this->favoritedBy()->where('user_id', auth()->id())->exists();
    }


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


    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }


    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
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


    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'device_type' => $this->device_type,
            'brand' => $this->phoneBrand?->name,
            'model' => $this->phoneModel?->name,
            'price' => $this->price,
            'condition' => $this->condition,
            'storage' => $this->storage_capacity,
            'ram' => $this->ram,
            'color' => $this->color,
            'location' => $this->user?->location
        ];
    }
}
