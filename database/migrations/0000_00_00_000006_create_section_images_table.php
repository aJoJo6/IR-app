<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// create section images table
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_images', function (Blueprint $table) {
            $table->id(); // primary key
            $table->foreignId('revolution_section_id')->constrained()->cascadeOnDelete(); // fk to section
            $table->string('image_path'); // image file path
            $table->string('caption')->nullable(); // optional caption
            $table->unsignedInteger('sort_order')->default(0); // image order
            $table->timestamps(); // created and updated timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_images'); 
    }
};