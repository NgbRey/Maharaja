<?php

namespace App\Console\Commands;

use App\Models\DigiflazzProduct;
use App\Services\DigiflazzClient;
use Illuminate\Console\Command;

class DigiflazzSyncCommand extends Command
{
    protected $signature = 'digiflazz:sync-products
                        {--only= : Filter brand/kategori (opsional)}
                        {--prune : Hapus produk yang sudah tidak ada di API}
                        {--hard : Hapus permanen (abaikan soft delete)}';

    protected $description = 'Sync daftar produk Digiflazz (prepaid) ke database lokal';

    public function handle(DigiflazzClient $api): int
{
    $this->info('Fetching price list from Digiflazz...');
    $json = $api->getPrepaidPriceList();

    $seen = [];   // kumpulkan sku yang masih ada di API
    $countUpsert = 0;

    foreach (($json['data'] ?? []) as $p) {
        // filter opsional
        if ($f = $this->option('only')) {
            if (
                !str_contains(strtolower($p['brand'] ?? ''), strtolower($f)) &&
                !str_contains(strtolower($p['category'] ?? ''), strtolower($f))
            ) continue;
        }

        $sku = $p['buyer_sku_code'];
        $seen[] = $sku;

        \App\Models\DigiflazzProduct::withTrashed() // supaya kalau pernah ke-soft-delete, bisa bangkit lagi
            ->updateOrCreate(
                ['buyer_sku_code' => $sku],
                [
                    'product_name'          => $p['product_name']      ?? null,
                    'brand'                 => $p['brand']             ?? null,
                    'category'              => $p['category']          ?? null,
                    'type'                  => $p['type']              ?? null,
                    'seller_name'           => $p['seller_name']       ?? null,
                    'price'                 => (int)($p['price']       ?? 0),
                    'unlimited_stock'       => (bool)($p['unlimited_stock'] ?? false),
                    'stock'                 => $p['stock']             ?? null,
                    'multi'                 => (bool)($p['multi']      ?? false),
                    'buyer_product_status'  => (bool)($p['buyer_product_status'] ?? true),
                    'seller_product_status' => (bool)($p['seller_product_status'] ?? true),
                    'start_cut_off'         => $p['start_cut_off']     ?? null,
                    'end_cut_off'           => $p['end_cut_off']       ?? null,
                    'desc'                  => $p['desc']              ?? null,
                ]
            )->restore(); // kalau sebelumnya soft-deleted, pulihkan

        $countUpsert++;
    }

    $this->info("Upserted {$countUpsert} products.");

    // === PRUNE: hapus yang tidak ada di API ===
    if ($this->option('prune')) {
        $this->warn('Pruning missing products from local DB...');

        $query = \App\Models\DigiflazzProduct::query();

        // batasi scope bila --only dipakai
        if ($f = $this->option('only')) {
            $query->where(function($q) use ($f) {
                $q->where('brand', 'like', "%{$f}%")
                  ->orWhere('category', 'like', "%{$f}%");
            });
        }

        // Jika di DB ada SKU yang tidak muncul di $seen → hapus
        if (!empty($seen)) {
            $query->whereNotIn('buyer_sku_code', $seen);
        }

        $deleted = 0;
        if ($this->option('hard')) {
            // hard delete
            $deleted = (clone $query)->forceDelete();
        } else {
            // soft delete
            $deleted = (clone $query)->delete();
        }

        $this->info("Pruned {$deleted} products.");
    }

    return self::SUCCESS;
    }
}
