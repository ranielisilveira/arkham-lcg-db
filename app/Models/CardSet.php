<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardSet extends Model
{
    protected $fillable = [
        "name",
        "order",
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'card_type_id');
    }
}