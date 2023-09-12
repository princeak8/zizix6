<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function client_services()
    {
        return $this->hasMany('App\Models\ClientPackageService', 'service_id', 'id');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\PriceList', 'service_id', 'id');
    }
}
