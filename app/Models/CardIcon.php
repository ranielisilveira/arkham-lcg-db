<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardIcon extends Model
{
    protected $fillable = [
        "name"
    ];

    public function cardsTraits()
    {
        return $this->belongsToMany(Card::class, 'card_card_icon', 'card_icon_id', 'card_id');
    }
}
