<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PhoneVariant extends Model implements HasMedia
{
    use HasFactory;

    use HasUlids;

    use InteractsWithMedia;

    protected $guarded = ['id'];


    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function phoneModels()
    {
        return $this->hasMany(PhoneModel::class);
    }


    public function phoneBrand()
    {
        return $this->belongsTo(PhoneBrand::class);
    }
}
