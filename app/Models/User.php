<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\BankAccount;
use App\Models\Charity;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    use HasUlids;

    use \OwenIt\Auditing\Auditable;

    use HasRoles;

    protected $guarded = ['id'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function beats()
    {
        return $this->hasMany(related: Beat::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedBeats()
    {
        return $this->belongsToMany(Beat::class, 'likes', 'user_id', 'beat_id')
            ->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')
            ->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')
            ->withTimestamps();
    }

    public function isFollowing(User $user): bool
    {
        return $this?->following()->where('following_id', $user->id)->exists() ?? false;
    }

    public function recentPlays()
    {
        return $this->hasMany(RecentPlay::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->user_slug = 'user-' . Str::random(12);
        });
    }
}
