<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title_fr');
            $table->string('title_en')->nullable();
            $table->text('description_fr')->nullable();
            $table->text('description_en')->nullable();
            $table->dateTime('date');
            $table->string('location')->nullable();
            $table->enum('status', ['upcoming','completed'])->default('upcoming');
            $table->boolean('is_active')->default(true);
            $table->string('slug')->unique()->nullable();
            $table->timestamps();
            $table->index(['date', 'is_active']);
        });
    }
    public function down(): void { Schema::dropIfExists('events'); }
};
