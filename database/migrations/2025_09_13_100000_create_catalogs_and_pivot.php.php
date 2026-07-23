<?php
// database/migrations/2025_09_13_100000_create_catalogs_and_pivot.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('catalogs', function (Blueprint $t) {
      $t->id();
      $t->string('name');
      $t->string('slug')->unique();
      $t->unsignedInteger('sort')->default(0);
      $t->timestamps();
    });

    Schema::create('catalog_product', function (Blueprint $t) {
      $t->id();
      $t->foreignId('catalog_id')->constrained()->cascadeOnDelete();
      $t->foreignId('digiflazz_product_id')->constrained()->cascadeOnDelete();
      $t->boolean('is_visible')->default(true);
      $t->unsignedInteger('sort')->default(0);
      $t->timestamps();
      $t->unique(['catalog_id','digiflazz_product_id']);
    });
  }
  public function down(): void {
    Schema::dropIfExists('catalog_product');
    Schema::dropIfExists('catalogs');
  }
};
