<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function desc()
    {
        return $this->hasMany(ServiceDescription::class);
    }
    public function media()
    {
        return $this->hasMany(ServiceMedia::class);
    }
}
