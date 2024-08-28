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
        Schema::create('gla_teams', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 150);
            $table->string('title');
            $table->text('description');
            $table->integer('status');
            $table->integer('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gla_teams');
    }
};
