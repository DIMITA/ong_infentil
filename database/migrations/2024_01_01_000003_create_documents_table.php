<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('category', ['rapport_annuel','bilan','communique','presentation','autre'])->default('rapport_annuel');
            $table->unsignedSmallInteger('year');
            $table->enum('visibility', ['public','private'])->default('public');
            $table->json('tags')->nullable();
            $table->timestamps();
            $table->index(['year', 'category', 'visibility']);
        });
    }
    public function down(): void { Schema::dropIfExists('documents'); }
};
