<?php

use Illuminate\Database\Seeder;
use App\Resource;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resource::create([
        	'title' => 'America Room'
        ]);

        Resource::create([
        	'title' => 'Night-time Room'
        ]);

        Resource::create([
        	'title' => 'Irrigation Room'
        ]);
    }
}
