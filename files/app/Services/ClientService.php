<?php

namespace App\Services;

use App\Models\Client;

class ClientService
{

    public function getClient($id)
    {
        return Client::find($id);
    }

    public function getClientWithServices($id)
    {
        return Client::with(['packages.services'])->where('id', $id)->first();
    }

    public function getParent()
    {
        return Client::where('default_client', 1)->first();
    }

    public function getClientByEmail($email)
    {
        return Client::where('email', $email)->first();
    }

    public function getAllClients()
    {
        return Client::all();
    }

    public function getClients($count=false)
    {
        $query = Client::where('default_client', 0);
        return ($count) ? $query->count() : $query->get();
    }

    public function save($data)
    {
        $client = new Client;
        $client->name = $data['name'];
        if(isset($data['email'])) $client->email = $data['email'];
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