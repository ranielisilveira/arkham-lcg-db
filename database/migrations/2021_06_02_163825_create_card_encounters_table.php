<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardEncountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_encounters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->unique();
            $table->integer('order')->unsigned();
            $table->timestamps();
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->integer('card_encounters_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_encounters');

        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn(['card_encounters_id']);
        });
    }
}