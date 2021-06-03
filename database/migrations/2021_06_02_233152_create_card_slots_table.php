<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_slot', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->unique();
            $table->timestamps();
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->integer('card_slot_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_slot');

        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn(['card_slot_id']);
        });
    }
}
