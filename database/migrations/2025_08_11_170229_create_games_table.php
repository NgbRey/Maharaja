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
    Schema::create('games', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
        $table->string('name');
        $table->string('slug')->unique();
        $table->string('image_path')->nullable(); // simpan path logo
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('sort')->default(0);
        $table->timestamps();
        $table->softDeletes();
        $table->unique(['category_id','name']); // unik per kategori
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
