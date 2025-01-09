<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    use HasUlids;

    protected $guarded = ['id'];


    protected $casts = [
        'features' => 'array'
    ];

    public function beats()
    {
        return $this->belongsToMany(Beat::class, 'beat_licenses');
    }

    public function beat()
    {
        return $this->belongsTo(Beat::class);
    }
}
