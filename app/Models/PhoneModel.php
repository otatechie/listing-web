<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
    use HasFactory;

    use HasUlids;

    protected $guarded = ['id'];


    public function phoneBrand()
    {
        return $this->belongsTo(PhoneBrand::class);
    }


    public function phoneVariant()
    {
        return $this->belongsTo(PhoneVariant::class);
    }
}
