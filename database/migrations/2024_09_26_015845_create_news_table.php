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
        Schema::create('news', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // News title
            $table->text('content'); // Full article content
            $table->unsignedBigInteger('author_id');
            $table->string('image_url')->nullable(); // Optional image URL for the article
            $table->dateTime('published_date')->nullable(); // Date and time when the news was published
            $table->string('category')->nullable(); // Category or type of the news
            $table->enum('status', ['draft', 'published'])->default('draft'); // Status of the article (only draft or published)
            $table->timestamps(); // Laravel-created columns for created_at and updated_at

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
