<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserProfile extends Model implements HasMedia
{
    use HasFactory;

    use HasUlids;

    use InteractsWithMedia;

    protected $guarded = ['id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_photo')
             ->singleFile(); // Ensures only one profile photo
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
