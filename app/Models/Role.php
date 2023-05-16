<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public static function superAdmin()
    {
        return self::where('name', 'super admin')->first();
    }

    public static function admin()
    {
        return self::where('name', 'admin')->first();
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
