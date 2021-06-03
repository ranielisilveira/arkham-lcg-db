<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardClass extends Model
{
    protected $fillable = [
        "name",
        "order",
        "icon",
        "color",
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'card_class_id');
    }
}
