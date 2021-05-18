<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        "name",
        "back_name",
        "subtitle",
        "text",
        "back_text",
        "front_description",
        "back_description",
        "front_image",
        "back_image",
        "unique",
        "is_weakness",
        "is_basic_weakness",
        "is_player_card",
        "health",
        "is_health_by_investigator",
        "sanity",
        "cost",
        "willpower",
        "intellect",
        "combat",
        "is_combat_by_investigator",
        "agility",
        "is_agility_by_investigator",
        "victory_points",
        "health_damage",
        "sanity_damage",
        "deck_size",
        "deck_options",
        "deck_requirements",
        "skull_effect_standard",
        "skull_effect_hard",
        "cultist_effect_standard",
        "cultist_effect_hard",
        "tablet_effect_standard",
        "tablet_effect_hard",
        "elderthing_effect_standard",
        "elderthing_effect_hard",
        "set_number",
        "set_collection_number",
        "is_doom_by_investigator",
        "clues",
        "is_clues_by_investigator",
        "shroud",
        "is_shroud_by_investigator",
        "xp",

        "card_type_id",
        "card_set_id",

    ];

    public function cardType()
    {
        return $this->belongsTo(CardType::class, 'card_type_id');
    }

}