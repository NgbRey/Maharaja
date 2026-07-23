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
        Schema::create('digiflazz_products', function (Blueprint $t) {
      $t->id();
      // Identitas dari Digiflazz
      $t->string('buyer_sku_code')->index();         // kode SKU pembeli
      $t->string('product_name');                    // nama produk
      $t->string('brand')->nullable();               // contoh: TELKOMSEL / MOBILE LEGENDS
      $t->string('category')->nullable();            // contoh: Pulsa / Data / Game
      $t->string('type')->nullable();                // prepaid / postpaid
      $t->string('seller_name')->nullable();

      // Harga & stok
      $t->unsignedBigInteger('price')->default(0);
      $t->boolean('unlimited_stock')->default(false);
      $t->integer('stock')->nullable();
      $t->boolean('multi')->default(false);

      // Status dari Digiflazz
      $t->boolean('buyer_product_status')->default(true);
      $t->boolean('seller_product_status')->default(true);

      // Info lain yang sering ada di response
      $t->string('start_cut_off')->nullable();
      $t->string('end_cut_off')->nullable();
      $t->text('desc')->nullable();

      // Kontrol tampilan lokal
      $t->boolean('is_visible')->default(true);      // show/hide di halaman daftar produk
      $t->timestamps();
      $t->unique(['buyer_sku_code']);                // pastikan unik per SKU
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digiflazz_products');
    }
};
