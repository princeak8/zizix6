<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Host;

class HostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hosts = ['namecheap', 'smartweb'];
        foreach($hosts as $hostName) {
            $host = new Host;
            $host->name = $hostName;
            $host->save();
        } 

    }
}
