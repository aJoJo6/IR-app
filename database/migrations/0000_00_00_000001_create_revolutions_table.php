<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// create revolutions table
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revolutions', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // public id
            $table->string('label'); // short label
            $table->string('title'); // full title
            $table->string('years'); // date range
            $table->text('summary'); // short summary
            $table->string('hero_image')->nullable(); // optional image
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revolutions');
    }
};