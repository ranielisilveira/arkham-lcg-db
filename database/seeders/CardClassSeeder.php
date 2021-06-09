<?php

namespace Database\Seeders;

use App\Models\CardClass;
use Illuminate\Database\Seeder;

class CardClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CardClass::truncate();

        $classes = [
            [
                "name" => "Guardian",
                "order" => 1,
                "icon" => 'https://arkhamdb.com/bundles/app/images/factions/guardian.png',
                "color" => '#1c77bb',
            ],
            [
                "name" => "Mystic",
                "order" => 2,
                "icon" => 'https://arkhamdb.com/bundles/app/images/factions/mystic.png',
                "color" => '#5d5593',
            ],
            [
                "name" => "Seeker",
                "order" => 3,
                "icon" => 'https://arkhamdb.com/bundles/app/images/factions/seeker.png',
                "color" => '#ff8f3f',
            ],
            [
                "name" => "Rogue",
                "order" => 4,
                "icon" => 'https://arkhamdb.com/bundles/app/images/factions/rogue.png',
                "color" => '#107116',
            ],
            [
                "name" => "Survivor",
                "order" => 5,
                "icon" => 'https://arkhamdb.com/bundles/app/images/factions/survivor.png',
                "color" => '#cc3038',
            ],
            [
                "name" => "Neutral",
                "order" => 6,
                "icon" => '',
                "color" => '#808080',
            ],
            [
                "name" => "Mythos",
                "order" => 7,
                "icon" => '',
                "color" => '#b59b68',
            ],
        ];


        foreach ($classes as $class) {
            CardClass::create($class);
        }
    }
}
