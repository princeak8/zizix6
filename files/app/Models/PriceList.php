<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;

    public function host()
    {
        return $this->belongsTo('App\Models\Host');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }
}
