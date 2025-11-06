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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('long_description');
            $table->json('tech'); // Array of technologies
            $table->json('images'); // Array of image URLs
            $table->string('github')->nullable();
            $table->string('live')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->json('features')->nullable(); // Array of features
            $table->text('challenges')->nullable();
            $table->text('outcome')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
