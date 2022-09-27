[![Packagist](https://img.shields.io/packagist/v/nda666/tokopedia-php.svg)](https://packagist.org/packages/nda666/tokopedia-php)
[![Packagist](https://img.shields.io/packagist/dt/nda666/tokopedia-php.svg)](https://packagist.org/packages/nda666/tokopedia-php)
![PHPUnit](https://github.com/nda666/tokopedia-php/actions/workflows/phpunit.yml/badge.svg)
![PHPStan](https://github.com/nda666/tokopedia-php/actions/workflows/phpstan.yml/badge.svg)
[![codecov](https://codecov.io/gh/nda666/tokopedia-php/branch/master/graph/badge.svg?token=R3LH0U32BZ)](https://codecov.io/gh/nda666/tokopedia-php)

# Tokopedia PHP

Tokopedia Rest Client for PHP

## Installation
```bash
composer require nda666/tokopedia-php
```

## Usage

```php
$tokopedia = new \TokopediaPhp\Tokopedia([
                'clientId' => env('TOKOPEDIA_CLIENT_ID'),
                'fsId' => env('TOKOPEDIA_FS_ID'),
                'clientSecret' => env('TOKOPEDIA_CLIENT_SECRET')
            ]);
$product = $tokopedia->product()->getProducts([
            'page' => $page,
            'per_page' => 50,
            'sort' => 1,
            'shop_id' => $shopId
        ])->getData();

echo json_encode($product);
// {
//   "header": {
//     "process_time": 5.871520385,
//     "messages": "Your request has been processed successfully"
//   },
//   "data": [
//     {
//       "basic": {
//         "productID": 15245228,
//         "shopID": 480829,
//         "status": 1,
//         "Name": "hxh wallpaper best la zzzz",
//         "condition": 1,
//         "childCategoryID": 1828,
//         "shortDesc": "Best wallpaper for hxh"
//       },
//       ...
//     }
//   ]
// }
```

## Task List

- [x] Product API
- [x] Order API
- [x] Shop API
- [x] Category API
- [x] Logistic API
- [ ] Campaign API
- [ ] Webhook API
- [x] Interaction API
- [x] Finance API
