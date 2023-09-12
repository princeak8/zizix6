<?php

namespace App\Services;

use App\Models\Host;

class HostService
{

    public function getHost($id)
    {
        return Host::find($id);
    }

    public function getHostByName($name)
    {
        return Host::where('name', $name)->first();
    }

    public function getHosts()
    {
        return Host::all();
    }

    public function save($data)
    {
        $host = new Host;
        $host->name = $data['name'];
        $host->save();
        return $host;
    }

    public function update($host, $data)
    {
        if(isset($data['name'])) $host->name = $data['name'];
        $host->update();
        return $host;
    }

    public function delete($host)
    {
        $host->delete();
    }
}