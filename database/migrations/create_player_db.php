<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('player_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->float('mana')->nullable();
            $table->float('defence')->nullable();
            $table->float('magic')->nullable();
            $table->integer('Inte')->nullable();
            $table->integer('Ma')->nullable();
            $table->integer('Uc')->nullable();
            $table->integer('Lu')->nullable();
            $table->integer('Com')->nullable();
            $table->integer('Agi')->nullable();
            $table->integer('Str')->nullable();
            $table->integer('Md')->nullable();
            $table->integer('Con')->nullable();
            $table->integer('Res')->nullable();
            $table->timestamps();
        });

        Schema::create('character_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('u_age')->nullable();
            $table->string('u_name', 200);
            $table->foreignId('race_id')->constrained('races');
            $table->foreignId('SubRace_id')->nullable()->constrained('races');
            $table->foreignId('class_id')->constrained('player_classes');
            $table->foreignId('subclass_id')->nullable()->constrained('player_classes');
            $table->integer('LVL');
            $table->string('aligment')->nullable();
            $table->float('money')->nullable();
            $table->float('hp')->nullable();
            $table->foreignId('stats_id')->constrained('stats');
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('character_profiles');
            $table->enum('type', ['WEAPON','ARMOR','CONSUMABLE','MISC']);
            $table->integer('Tier')->nullable();
            $table->float('price')->nullable();
            $table->float('size')->nullable();
            $table->binary('image')->nullable(); // Use string if you want URL instead
            $table->string('i_name');
            $table->text('i_desc')->nullable();
            $table->float('bonus')->nullable();
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('character_profiles');
            $table->string('s_name');
            $table->text('s_desc')->nullable();
            $table->float('bonus')->nullable();
            $table->enum('s_type', ['ACTIVE','PASSIVE','TRIGGERED']);
            $table->integer('mana_cost')->nullable();
            $table->integer('hp_cost')->nullable();
            $table->enum('bonus_on_stat', ['Int','Ma','Uc','Lu','Com','Agi','Str','Md','Con','Res'])->nullable();
            $table->timestamps();
        });

        Schema::create('magics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('character_profiles');
            $table->integer('magiccircles_id');
            $table->integer('lvl')->nullable();
            $table->float('mana_cost')->nullable();
            $table->integer('tier')->nullable();
            $table->string('m_name');
            $table->string('effect', 500)->nullable();
            $table->text('m_escription')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('races');
        Schema::dropIfExists('player_classes');
        Schema::dropIfExists('stats');
        Schema::dropIfExists('character_profiles');
        Schema::dropIfExists('items');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('magics');
    }
};
