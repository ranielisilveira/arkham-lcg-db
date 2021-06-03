<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardEncouter extends Model
{
    protected $fillable = [
        "name",
        "order",
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'card_encounter_id');
    }
}
