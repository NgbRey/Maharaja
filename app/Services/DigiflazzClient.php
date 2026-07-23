<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DigiflazzClient
{
    protected string $base;
    protected string $username;
    protected string $apiKey;

    public function __construct()
    {
        $this->base     = config('digiflazz.base_url');
        $this->username = config('digiflazz.username');
        $this->apiKey   = config('digiflazz.api_key');
    }

    protected function sign(string $kind): string
    {
        // Untuk daftar harga: 'pricelist'
        return md5($this->username . $this->apiKey . $kind);
    }

    /** Ambil daftar harga PREPAID */
    public function getPrepaidPriceList()
    {
        $payload = [
            'cmd'      => 'prepaid',
            'username' => $this->username,
            'sign'     => $this->sign('pricelist'),
        ];

        $res = Http::withHeaders(['Accept'=>'application/json'])
                   ->post($this->base . '/price-list', $payload);

        if (!$res->ok()) {
            throw new \RuntimeException('Digiflazz error: '.$res->status().' '.$res->body());
        }
        return $res->json(); // biasanya: ['data'=>[...]]
    }

    public function orderTopup(array $payload) {
  // contoh payload (lihat docs Digiflazz sesuai produk):
  // [
  //   'username' => $this->username,
  //   'buyer_sku_code' => 'ML86',
  //   'customer_no'    => '12345678',   // id akun
  //   'ref_id'         => 'ORD-xxxxx',  // unik dari kita (order_code)
  //   'sign'           => md5(username + api_key + ref_id)
  // ]
  $payload['username'] = $this->username;
  $payload['sign']     = md5($this->username.$this->apiKey.$payload['ref_id']);

  $res = \Http::post($this->base.'/transaction', $payload);
  if (!$res->ok()) throw new \RuntimeException('DF order error: '.$res->body());
  return $res->json();
}
}
