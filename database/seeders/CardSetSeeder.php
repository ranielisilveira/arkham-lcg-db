<?php

namespace Database\Seeders;

use App\Models\CardSet;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class CardSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CardSet::truncate();

        $sets = [
            [
                "name" => "Core Set",
                "order" => 1
            ],
            [
                "name" => "The Dunwich Legacy",
                "order" => 2
            ],
            [
                "name" => "The Miskatonic Museum",
                "order" => 3
            ],
            [
                "name" => "The Essex County Express",
                "order" => 4
            ],
            [
                "name" => "Blood on the Altar",
                "order" => 5
            ],
            [
                "name" => "Undimensioned and Unseen",
                "order" => 6
            ],
            [
                "name" => "Where Doom Awaits",
                "order" => 7
            ],
            [
                "name" => "Lost in Time and Space",
                "order" => 8
            ],
        ];

        foreach ($sets as $set) {
            CardSet::create($set);
        }
    }
}
