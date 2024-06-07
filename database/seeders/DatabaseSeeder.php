<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\DB;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\SpatieSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\GuestHouseSeeder;
use Database\Seeders\IdCardTypeSeeder;
use Database\Seeders\RoomStatusSeeder;
use Database\Seeders\BedCategorySeeder;
use Database\Seeders\RoomCategorySeeder;
use Database\Seeders\GuestCategorySeeder;
use Database\Seeders\ReservationReasonSeeder;
use Database\Seeders\ReservationStatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SpatieSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(GuestCategorySeeder::class);
        $this->call(GuestHouseSeeder::class);
        $this->call(IdCardTypeSeeder::class);
        $this->call(RoomCategorySeeder::class);
        $this->call(BedCategorySeeder::class);
        $this->call(ReservationReasonSeeder::class);
        $this->call(ReservationStatusSeeder::class);
        $this->call(RoomStatusSeeder::class);
        $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
