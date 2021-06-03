<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->unique();
            $table->text('icon')->nullable();
            $table->string('color')->nullable();
            $table->integer('order')->unsigned();
            $table->timestamps();
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->integer('card_classes_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_classes');

        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn(['card_classes_id']);
        });
    }
}
