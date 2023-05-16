<?php

namespace App\Services;

use App\Models\Client;

class ClientService
{

    public function getClient($id)
    {
        return Client::find($id);
    }

    public function getClientByEmail($email)
    {
        return Client::where('email', $email)->first();
    }

    public function getClients()
    {
        return Client::all();
    }

    public function save($data)
    {
        $client = new Client;
        $client->firstname = $data['firstname'];
        $client->lastname = $data['lastname'];
        $client->email = $data['email'];
        $client->phone_number = $data['phone_number'];
        $client->save();
        return $client;
    }

    public function update($client, $data)
    {
        if(isset($data['firstname'])) $client->firstname = $data['firstname'];
        if(isset($data['lastname'])) $client->lastname = $data['lastname'];
        if(isset($data['email'])) $client->email = $data['email'];
        if(isset($data['phone_number'])) $client->phone_number = $data['phone_number'];
        $client->update();
        return $client;
    }
}