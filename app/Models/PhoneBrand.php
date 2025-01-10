<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneBrand extends Model
{
    use HasFactory;

    use HasUlids;

    protected $guarded = ['id'];

    public function phoneModels()
    {
        return $this->hasMany(PhoneModel::class);
    }
}
