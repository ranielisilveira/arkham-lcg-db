<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardTrait extends Model
{
    protected $fillable = [
        "name"
    ];

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'card_card_trait', 'card_trait_id', 'card_id');
    }
}
