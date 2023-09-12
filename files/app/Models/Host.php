<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->hasMany('App\Models\ClientPackageService', 'host_id', 'id');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\PriceList', 'host_id', 'id');
    }
}
