<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardSlot extends Model
{
    protected $fillable = [
        "name",
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'card_slot_id');
    }
}
