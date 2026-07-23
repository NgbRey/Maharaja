<?php
// app/Services/TripayClient.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class TripayClient {
  public function channels() {
    return Http::withToken(config('tripay.api_key'))
      ->get(config('tripay.api_base').'/payment/channel')->json();
  }
  
  public function createTransaction(array $payload) {
    return Http::withToken(config('tripay.api_key'))
      ->post(config('tripay.api_base').'/transaction/create', $payload)
      ->json();
  }
  public static function signature(string $merchantRef, int $amount): string {
    return hash_hmac(
      'sha256',
      config('tripay.merchant_code').$merchantRef.$amount,
      config('tripay.private_key')
    );
  }
}
