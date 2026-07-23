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
    Schema::create('catalog_products', function (Blueprint $t) {
        $t->id();
        $t->enum('category', ['games','pulsa','lainnya']); // tab di home
        $t->string('name');
        $t->string('slug')->unique();
        $t->string('developer')->nullable();
        $t->string('thumbnail_path')->nullable(); // storage path
        $t->boolean('is_active')->default(true);
        $t->unsignedInteger('sort')->default(0);
        $t->timestamps();
        $t->softDeletes();
        $t->unique(['category','name']); // unik per kategori
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_products');
    }
};
