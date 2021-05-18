<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{
    protected $fillable = [
        "name"
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'card_type_id');
    }
}
