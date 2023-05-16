<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "firstname" => "Akachukwu Edwin",
                "lastname" => "Edwin",
                "email" => "akalodave@gmail.com",
                "password" =>  bcrypt("akalo123"),
                "role_id" => Role::superAdmin()->id
            ],
        ];

        foreach($users as $user) { //dd($user['name']);
            $userObj = new User;
            $userObj->firstname = $user['firstname'];
            $userObj->lastname = $user['lastname'];
            $userObj->email = $user['email'];
            $userObj->password = $user['password'];
            $userObj->role_id = $user['role_id'];
            $userObj->save();
        }
    }
}
