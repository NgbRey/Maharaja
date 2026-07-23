<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('banners', function (Blueprint $t) {
        $t->id();
        $t->string('title')->nullable();
        $t->string('image_path');              // storage path
        $t->string('link_url')->nullable();    // klik banner menuju URL
        $t->boolean('is_active')->default(true);
        $t->unsignedInteger('sort')->default(0);
        $t->timestamps();
        $t->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
