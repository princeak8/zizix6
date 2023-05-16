<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function getNameAttribute()
    {
        $fullname = '';
        if($this->firstname && !empty($this->firstname)) $fullname .= $this->firstname.' ';
        if($this->lastname && !empty($this->lastname)) $fullname .= $this->lastname.' ';
        return $fullname;
    }

    public function client_services()
    {
        return $this->hasMany('App\Models\ClientPackageService', 'client_id', 'id');
    }

    public function packages()
    {
        return $this->hasMany('App\Models\ClientPackage', 'client_id', 'id');
    }
}
