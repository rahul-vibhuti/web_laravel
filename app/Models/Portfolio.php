<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    public  function skills()
    {
        return $this->hasMany(portfolioSkills::class);
    }
}
