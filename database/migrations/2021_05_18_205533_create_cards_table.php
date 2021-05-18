<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('back_name')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('text')->nullable();
            $table->text('back_text')->nullable();
            $table->text('front_description')->nullable();
            $table->text('back_description')->nullable();
            $table->text('front_image')->nullable();
            $table->text('back_image')->nullable();
            $table->boolean('unique')->default(false);
            $table->boolean('is_weakness')->default(false);
            $table->boolean('is_basic_weakness')->default(false);
            $table->boolean('is_player_card')->default(false);
            $table->integer('health')->unsigned()->nullable();
            $table->boolean('is_health_by_investigator')->default(false);
            $table->integer('sanity')->unsigned()->nullable();
            $table->integer('cost')->unsigned()->nullable();
            $table->integer('willpower')->unsigned()->nullable();
            $table->integer('intellect')->unsigned()->nullable();
            $table->integer('combat')->unsigned()->nullable();
            $table->boolean('is_combat_by_investigator')->default(false);
            $table->integer('agility')->unsigned()->nullable();
            $table->boolean('is_agility_by_investigator')->default(false);
            $table->integer('victory_points')->unsigned()->nullable();
            $table->integer('health_damage')->unsigned()->nullable();
            $table->integer('sanity_damage')->unsigned()->nullable();
            $table->integer('deck_size')->unsigned()->nullable();
            $table->text('deck_options')->nullable();
            $table->text('deck_requirements')->nullable();
            $table->text('skull_effect_standard')->nullable();
            $table->text('skull_effect_hard')->nullable();
            $table->text('cultist_effect_standard')->nullable();
            $table->text('cultist_effect_hard')->nullable();
            $table->text('tablet_effect_standard')->nullable();
            $table->text('tablet_effect_hard')->nullable();
            $table->text('elderthing_effect_standard')->nullable();
            $table->text('elderthing_effect_hard')->nullable();
            $table->string('set_number')->nullable();
            $table->string('set_collection_number')->nullable();
            $table->boolean('is_doom_by_investigator')->default(false);
            $table->integer('clues')->unsigned()->nullable();
            $table->boolean('is_clues_by_investigator')->default(false);
            $table->integer('shroud')->unsigned()->nullable();
            $table->boolean('is_shroud_by_investigator')->default(false);
            $table->integer('xp')->unsigned()->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
