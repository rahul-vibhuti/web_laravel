<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryService extends Model
{
    use HasFactory;

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
