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
        Schema::create('catalog_product_mappings', function (Blueprint $table) {
            $table->id();
            // section = folder di views/pages/produk (games | pulsa | lainnya)
            $table->enum('section', ['games','pulsa','lainnya']);
            // slug halaman di dalam section (contoh: mobile-legends)
            $table->string('slug', 120);
            // relasi ke produk asli dari Digiflazz
            $table->unsignedBigInteger('digiflazz_product_id');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['section','slug','digiflazz_product_id'], 'uniq_map');
            $table->foreign('digiflazz_product_id')
                  ->references('id')->on('digiflazz_products')
                  ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_product_mappings');
    }
};
