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
        Schema::create('creatures', function (Blueprint $table) {
            $table->id();
            $name_creature = $table->string('name')->unique();
            $pv = $table->integer('pv')->default(0);
            $atk = $table->integer('atk')->default(0);
            $def = $table->integer('def')->default(0);
            $speed = $table->integer('speed')->default(0);
            $type = $table->string('type')->default('Unknown');
            $race = $table->string('race')->default('Unknown');
            $capture_rate = $table->integer('capture_rate')->default(0);
            $avatar = $table->string('avatar')->default('default_avatar.png');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creatures');
    }
};
