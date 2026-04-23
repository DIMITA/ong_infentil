<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title_fr');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->text('excerpt_fr')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('content_fr')->nullable();
            $table->longText('content_en')->nullable();
            $table->string('category')->nullable();
            $table->string('author_name')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->string('meta_description_fr', 160)->nullable();
            $table->string('meta_description_en', 160)->nullable();
            $table->timestamps();

            $table->index(['is_published', 'published_at']);
            $table->index(['category', 'is_published']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
