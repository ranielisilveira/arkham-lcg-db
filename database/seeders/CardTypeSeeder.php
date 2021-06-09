<?php

namespace Database\Seeders;

use App\Models\CardType;
use Illuminate\Database\Seeder;

class CardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CardType::truncate();

        $types = [
            ["name" => "Investigator"],
            ["name" => "Asset"],
            ["name" => "Treachery"],
            ["name" => "Event"],
            ["name" => "Skill"],
            ["name" => "Enemy"],
            ["name" => "Scenario"],
            ["name" => "Agenda"],
            ["name" => "Location"],
            ["name" => "Act"],
        ];

        foreach ($types as $type) {
            CardType::create($type);
        }
    }
}
