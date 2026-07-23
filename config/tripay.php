<?php
return [
  'api_base'      => env('TRIPAY_API_BASE','https://tripay.co.id/api'),
  'merchant_code' => env('TRIPAY_MERCHANT_CODE',''),
  'api_key'       => env('TRIPAY_API_KEY',''),
  'private_key'   => env('TRIPAY_PRIVATE_KEY',''), // for signature callback
  // 'mode'          => env('TRIPAY_MODE','dev'),     // dev/prod
  // 'return_url'    => env('TRIPAY_RETURN_URL', url('/transaksi/finish')),
  // 'callback_url'  => env('TRIPAY_CALLBACK_URL', url('/webhook/tripay')),
];
