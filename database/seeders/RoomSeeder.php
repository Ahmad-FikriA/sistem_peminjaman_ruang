<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Ruangan BR',
                'description' => 'Ruangan dingin!!',
                'location' => 'FT Cilegon',
                'capacity' => 25,
                'is_available' => true,
            ],
            [
                'name' => 'Gedung CoE',
                'description' => 'Gedung mevvah!!',
                'location' => 'FT Cilegon',
                'capacity' => 25,
                'is_available' => true,
            ],
            [
                'name' => 'Letter U 2.5',
                'description' => 'Ruangan yang berada di gedung U',
                'location' => 'FT Cilegon',
                'capacity' => 25,
                'is_available' => true,
            ],
            [
                'name' => 'Auditorium',
                'description' => 'Ruangan besar untuk acara besar',
                'location' => 'FT Cilegon',
                'capacity' => 50,
                'is_available' => true,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
