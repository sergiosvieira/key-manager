<?php

use App\Models\Key;
use App\Models\Sector;
use App\Models\SubSector;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            "name" => "Admin",
            "email" => "admin@ifce",
            "password" => bcrypt('admin'),
            "type" => "admin",
        ]);
        User::create([
            "name" => "gatekeeper",
            "email" => "gatekeeper@ifce",
            "password" => bcrypt('admin'),
            "type" => "gatekeeper",
        ]);
        for ($i=0; $i<100; $i++) {
            User::create([
                "name" => "User" . $i,
                "email" => "user@ifce".$i,
                "password" => bcrypt('admin'),
                "type" => "user",
            ]);
        }
        SubSector::create([
            "name" => "Térreo",
        ]);
        SubSector::create([
            "name" => "Superior",
        ]);
        $sector = Sector::create([
            "name" => "Setor 01",
        ]);
        $sector->sub_sector()->attach([1, 2]);
        for ($i = 0; $i < 100; $i++) {
            Key::create([
                "name" => "Gabinete 1".$i,
                "sector_sub_sector_id" => 1,
            ]);
        }
        for ($i = 0; $i < 100; $i++) {
            Key::create([
                "name" => "Gabinete 2".$i,
                "sector_sub_sector_id" => 2,
            ]);
        }
    }
}
