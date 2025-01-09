<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentPlay extends Model
{
    use HasFactory;

    use HasUlids;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beat()
    {
        return $this->belongsTo(Beat::class);
    }

    protected static function booted()
    {
        static::saving(function ($recentPlay) {
            // Check and update existing record before save
            $existing = static::where('user_id', $recentPlay->user_id)
                ->where('beat_id', $recentPlay->beat_id)
                ->first();

            if ($existing) {
                $existing->play_timestamp = $recentPlay->play_timestamp;
                $existing->device = $recentPlay->device;
                $existing->save();

                return false;
            }

            // Get the count of plays for this user
            $count = static::where('user_id', $recentPlay->user_id)->count();

            // If at 20 plays, delete the oldest one before adding new
            if ($count >= 20) {
                static::where('user_id', $recentPlay->user_id)
                    ->orderBy('play_timestamp', 'asc')
                    ->first()
                    ->delete();
            }

            return true;
        });
    }
}
