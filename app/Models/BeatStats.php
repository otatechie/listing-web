<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeatStats extends Model
{
    use HasFactory;

    use HasUlids;

    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'beat_id';
    }

    public function beat()
    {
        return $this->belongsTo(Beat::class, 'beat_id');
    }
}
