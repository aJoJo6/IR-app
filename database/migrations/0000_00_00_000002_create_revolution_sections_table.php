<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// create revolution sections table
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revolution_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('revolution_id')->constrained()->cascadeOnDelete(); // parent
            $table->string('section_key'); // internal key
            $table->string('section_title'); // display title
            $table->longText('body'); // section content
            $table->string('image_path')->nullable(); // optional image
            $table->unsignedInteger('sort_order')->default(0); // display order
            $table->timestamps();

            $table->unique(['revolution_id', 'section_key']); // one of each section per revolution
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revolution_sections');
    }
};