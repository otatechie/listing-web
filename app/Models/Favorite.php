<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    use HasUlids;

    protected $guarded = ['id'];


    public function mobileDevice()
    {
        return $this->belongsTo(MobileDevice::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
