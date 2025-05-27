<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    /** @use HasFactory<\Database\Factories\TimezoneFactory> */
    use HasFactory;


    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }
}
