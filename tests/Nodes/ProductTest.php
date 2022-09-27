<?php

namespace TokopediaPhp\Tests\Nodes;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use TokopediaPhp\Tests\ClientTrait;
use TokopediaPhp\Tests\TokopediaTrait;

/**
 * @category Test for Product Node
 * @package  test
 * @author   Adha Bakhtiar <adhabakhtiar@gmail.com>
 * @license  MIT
 * @link    https://github.com/nda666/tokopedia-php
 */
class ProductTest extends TestCase
{
    use TokopediaTrait;

    public function testCheckUploadStatus()
    {
        $expected = [
            "header" => [
                "process_time" => 0.045122173,
                "messages" => "Your request has been processed successfully"
            ],
            "data" => [
                "upload_data" => [
                    [
                        "upload_id" => 0,
                        "status" => "DONE",
                        "total_data" => 1,
                        "unprocessed_rows" => 0,
                        "success_rows" => 1,
                        "failed_rows" => 0,
                        "processed" => 1
                    ]
                ]
            ]
        ];
        $response = new Response(200, ['content-type' => 'application/json'], json_encode($expected));

        $history = [];

        /** @var \TokopediaPhp\Tokopedia $tokopedia */
        $tokopedia = $this->createClient([
            'fsId' => 87654321
        ], $this->createHttpClient($response, $history));

        /** @var ResponseData $responseData */
        $responseData = $tokopedia->product()->checkUploadStatus(12345, ['shop_id' => 12345]);


        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals(json_decode(json_encode($expected)), $responseData->getData());
    }

    /**
     * @dataProvider casesProvider
     * @param string $node
     * @param mixed $params
     * @param mixed $body
     * @param mixed $expected
     * @return void
     */
    public function testMethod($node, $params, $body = [], $expected = [])
    {
        $response = new Response(200, ['content-type' => 'application/json'], json_encode($expected));
        $history = [];

        $client = $this->createClient([
            'fsId' => 87654321
        ], $this->createHttpClient($response, $history));

        /** @var ResponseData $responseData */
        $responseData = $body ? $client->product()->$node($params, $body) : $client->product()->$node($params);


        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals(json_decode(json_encode($expected)), $responseData->getData());
    }

    public function casesProvider(): array
    {

        return [
            'Get Product' => [
                'getProducts',
                [
                    'product_id' => 15341594,
                ],
                null,
                [
                    "header" => [
                        "process_time" => 5.871520385,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        [
                            "basic" => [
                                "productID" => 15245228,
                                "shopID" => 480829,
                                "status" => 1,
                                "Name" => "hxh wallpaper best la zzzz",
                                "condition" => 1,
                                "childCategoryID" => 1828,
                                "shortDesc" => "Best wallpaper for hxh"
                            ],
                            "price" => [
                                "value" => 3000,
                                "currency" => 1,
                                "LastUpdateUnix" => 1557981264,
                                "idr" => 3000
                            ],
                            "weight" => [
                                "value" => 5,
                                "unit" => 1
                            ],
                            "stock" => [
                                "value" => 10,
                                "stockWording" => "<b>Stok hampir habis!</b> Tersisa &lt;20"
                            ],
                            "main_stock" => 7,
                            "reserve_stock" => 3,
                            "variant" => [
                                "isParent" => true,
                                "isVariant" => true,
                                "childrenID" => [
                                    15245978,
                                    15245979
                                ]
                            ],
                            "menu" => [
                                "id" => 1405065,
                                "Name" => "Wallpapers"
                            ],
                            "preorder" => [],
                            "extraAttribute" => [
                                "minOrder" => 1,
                                "lastUpdateCategory" => 1554708202,
                                "isEligibleCOD" => true
                            ],
                            "categoryTree" => [
                                [
                                    "id" => 1759,
                                    "Name" => "Fashion Pria",
                                    "title" => "Fashion Pria",
                                    "breadcrumbURL" => "https://staging.tokopedia.com/p/fashion-pria"
                                ],
                                [
                                    "id" => 1787,
                                    "Name" => "Celana",
                                    "title" => "Celana",
                                    "breadcrumbURL" => "https://staging.tokopedia.com/p/fashion-pria/celana"
                                ],
                                [
                                    "id" => 1828,
                                    "Name" => "Celana Jeans",
                                    "title" => "Celana Jeans",
                                    "breadcrumbURL" => "https://staging.tokopedia.com/p/fashion-pria/celana/celana-jeans"
                                ]
                            ],
                            "pictures" => [
                                [
                                    "picID" => 21189631,
                                    "fileName" => "5510908_a4b5f7a2-2451-45f2-8a83-979808fe28d3_1920_1080.jpg",
                                    "filePath" => "product-1/2019/3/12/5510908",
                                    "status" => 2,
                                    "OriginalURL" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2019/3/12/5510908/5510908_a4b5f7a2-2451-45f2-8a83-979808fe28d3_1920_1080.jpg",
                                    "ThumbnailURL" => "https://ecs7.tokopedia.net/img/cache/200-square/product-1/2019/3/12/5510908/5510908_a4b5f7a2-2451-45f2-8a83-979808fe28d3_1920_1080.jpg",
                                    "width" => 1920,
                                    "height" => 1080,
                                    "URL300" => "https://ecs7.tokopedia.net/img/cache/300/product-1/2019/3/12/5510908/5510908_a4b5f7a2-2451-45f2-8a83-979808fe28d3_1920_1080.jpg"
                                ],
                                [
                                    "picID" => 21191044,
                                    "fileName" => "5510908_a99b769d-5e7a-44da-9a04-2ed1cc6efa32_441_441",
                                    "filePath" => "product-1/2019/4/8/5510908",
                                    "status" => 1,
                                    "OriginalURL" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2019/4/8/5510908/5510908_a99b769d-5e7a-44da-9a04-2ed1cc6efa32_441_441",
                                    "ThumbnailURL" => "https://ecs7.tokopedia.net/img/cache/200-square/product-1/2019/4/8/5510908/5510908_a99b769d-5e7a-44da-9a04-2ed1cc6efa32_441_441",
                                    "width" => 441,
                                    "height" => 441,
                                    "URL300" => "https://ecs7.tokopedia.net/img/cache/300/product-1/2019/4/8/5510908/5510908_a99b769d-5e7a-44da-9a04-2ed1cc6efa32_441_441"
                                ]
                            ],
                            "GMStats" => [
                                "transactionSuccess" => 3,
                                "transactionReject" => 69,
                                "countSold" => 3
                            ],
                            "stats" => [
                                "countView" => 163
                            ],
                            "other" => [
                                "sku" => "12345",
                                "url" => "https://staging.tokopedia.com/mattleeshoppe/hxh-wallpaper-best-la-zzzz",
                                "mobileURL" => "https://m-staging.tokopedia.com/mattleeshoppe/hxh-wallpaper-best-la-zzzz"
                            ],
                            "campaign" => [
                                "StartDate" => "0001-01-01T00:00:00Z",
                                "EndDate" => "0001-01-01T00:00:00Z"
                            ],
                            "warehouses" => [
                                [
                                    "productID" => 15245228,
                                    "warehouseID" => 5,
                                    "price" => [
                                        "value" => 3000,
                                        "currency" => 1,
                                        "LastUpdateUnix" => 1558006464,
                                        "idr" => 3000
                                    ],
                                    "stock" => [
                                        "useStock" => true,
                                        "value" => 10
                                    ]
                                ],
                                [
                                    "productID" => 15245228,
                                    "warehouseID" => 84,
                                    "price" => [
                                        "value" => 3000,
                                        "currency" => 1,
                                        "LastUpdateUnix" => 1558006464,
                                        "idr" => 3000
                                    ],
                                    "stock" => [
                                        "useStock" => true,
                                        "value" => 1
                                    ]
                                ],
                                [
                                    "productID" => 15245228,
                                    "warehouseID" => 96,
                                    "price" => [
                                        "value" => 3000,
                                        "currency" => 1,
                                        "LastUpdateUnix" => 1558006464,
                                        "idr" => 3000
                                    ],
                                    "stock" => [
                                        "useStock" => true,
                                        "value" => 1000
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ],
            'Get Product Variant By Product Id' => [
                'getProductVariantByProductId',
                15240600,
                null,
                [
                    "header" => [
                        "process_time" => 0.92548774,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "parent_id" => 15330203,
                        "default_child" => 15330204,
                        "sizechart" => "",
                        "variant" => [
                            [
                                "name" => "warna",
                                "identifier" => "colour",
                                "unit_name" => "",
                                "position" => 1,
                                "option" => [
                                    [
                                        "id" => 41368,
                                        "value" => "Hijau",
                                        "hex" => "#006400"
                                    ],
                                    [
                                        "id" => 41369,
                                        "value" => "Merah",
                                        "hex" => "#ff0016"
                                    ]
                                ]
                            ],
                            [
                                "name" => "ukuran",
                                "identifier" => "size",
                                "unit_name" => "Default",
                                "position" => 2,
                                "option" => [
                                    [
                                        "id" => 41371,
                                        "value" => "XL",
                                        "hex" => ""
                                    ],
                                    [
                                        "id" => 41370,
                                        "value" => "All Size",
                                        "hex" => ""
                                    ]
                                ]
                            ]
                        ],
                        "children" => [
                            [
                                "name" => "Toped Ijo - Hijau, All Size",
                                "url" => "https://staging.tokopedia.com/tkpdcoba/toped-ijo-hijau-all-size",
                                "product_id" => 15330204,
                                "price" => 100,
                                "price_fmt" => "Rp 100",
                                "stock" => 29,
                                "main_stock" => 27,
                                "reserve_stock" => 2,
                                "sku" => "ijo-all",
                                "option_ids" => [
                                    41368,
                                    41370
                                ],
                                "enabled" => true,
                                "is_buyable" => true,
                                "is_wishlist" => false,
                                "picture" => [
                                    "original" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2020/2/3/8974926/8974926_d0a57f36-c4fc-45a5-9ff1-7f23187ff18a_2048_2047",
                                    "thumbnail" => "https://ecs7.tokopedia.net/img/cache/200-square/product-1/2020/2/3/8974926/8974926_d0a57f36-c4fc-45a5-9ff1-7f23187ff18a_2048_2047"
                                ],
                                "campaign" => [
                                    "is_active" => false,
                                    "discounted_percentage" => 0,
                                    "discounted_price" => 0,
                                    "discounted_price_fmt" => "",
                                    "campaign_type" => 0,
                                    "campaign_type_name" => "",
                                    "start_date" => "",
                                    "end_date" => ""
                                ],
                                "always_available" => false,
                                "stock_wording" => "Stok terbatas! Tersedia >20",
                                "other_variant_stock" => "available",
                                "is_limited_stock" => false
                            ],
                            [
                                "name" => "Toped Ijo - Merah, All Size",
                                "url" => "https://staging.tokopedia.com/tkpdcoba/toped-ijo-merah-all-size",
                                "product_id" => 15330205,
                                "price" => 200,
                                "price_fmt" => "Rp 200",
                                "stock" => 10,
                                "main_stock" => 10,
                                "sku" => "abang-all",
                                "option_ids" => [
                                    41369,
                                    41370
                                ],
                                "enabled" => true,
                                "is_buyable" => true,
                                "is_wishlist" => false,
                                "picture" => [
                                    "original" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2020/2/3/8974926/8974926_d0a57f36-c4fc-45a5-9ff1-7f23187ff18a_2048_2047",
                                    "thumbnail" => "https://ecs7.tokopedia.net/img/cache/200-square/product-1/2020/2/3/8974926/8974926_d0a57f36-c4fc-45a5-9ff1-7f23187ff18a_2048_2047"
                                ],
                                "campaign" => [
                                    "is_active" => false,
                                    "discounted_percentage" => 0,
                                    "discounted_price" => 0,
                                    "discounted_price_fmt" => "",
                                    "campaign_type" => 0,
                                    "campaign_type_name" => "",
                                    "start_date" => "",
                                    "end_date" => ""
                                ],
                                "always_available" => false,
                                "stock_wording" => "Stok hampir habis! Tersisa <20",
                                "other_variant_stock" => "available",
                                "is_limited_stock" => false
                            ],
                            [
                                "name" => "Toped Ijo - Hijau, XL",
                                "url" => "https://staging.tokopedia.com/tkpdcoba/toped-ijo-hijau-xl",
                                "product_id" => 15330206,
                                "price" => 300,
                                "price_fmt" => "Rp 300",
                                "stock" => 40,
                                "main_stock" => 40,
                                "sku" => "ijo-xl",
                                "option_ids" => [
                                    41368,
                                    41371
                                ],
                                "enabled" => true,
                                "is_buyable" => true,
                                "is_wishlist" => false,
                                "picture" => [
                                    "original" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2020/2/3/8974926/8974926_d0a57f36-c4fc-45a5-9ff1-7f23187ff18a_2048_2047",
                                    "thumbnail" => "https://ecs7.tokopedia.net/img/cache/200-square/product-1/2020/2/3/8974926/8974926_d0a57f36-c4fc-45a5-9ff1-7f23187ff18a_2048_2047"
                                ],
                                "campaign" => [
                                    "is_active" => false,
                                    "discounted_percentage" => 0,
                                    "discounted_price" => 0,
                                    "discounted_price_fmt" => "",
                                    "campaign_type" => 0,
                                    "campaign_type_name" => "",
                                    "start_date" => "",
                                    "end_date" => ""
                                ],
                                "always_available" => false,
                                "stock_wording" => "Stok terbatas! Tersedia >20",
                                "other_variant_stock" => "available",
                                "is_limited_stock" => false
                            ],
                            [
                                "name" => "Toped Ijo - Merah, XL",
                                "url" => "https://staging.tokopedia.com/tkpdcoba/toped-ijo-merah-xl",
                                "product_id" => 15330207,
                                "price" => 400,
                                "price_fmt" => "Rp 400",
                                "stock" => 10,
                                "main_stock" => 10,
                                "sku" => "abang-all",
                                "option_ids" => [
                                    41369,
                                    41371
                                ],
                                "enabled" => true,
                                "is_buyable" => true,
                                "is_wishlist" => false,
                                "picture" => [
                                    "original" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2020/2/3/8974926/8974926_d0a57f36-c4fc-45a5-9ff1-7f23187ff18a_2048_2047",
                                    "thumbnail" => "https://ecs7.tokopedia.net/img/cache/200-square/product-1/2020/2/3/8974926/8974926_d0a57f36-c4fc-45a5-9ff1-7f23187ff18a_2048_2047"
                                ],
                                "campaign" => [
                                    "is_active" => false,
                                    "discounted_percentage" => 0,
                                    "discounted_price" => 0,
                                    "discounted_price_fmt" => "",
                                    "campaign_type" => 0,
                                    "campaign_type_name" => "",
                                    "start_date" => "",
                                    "end_date" => ""
                                ],
                                "always_available" => false,
                                "stock_wording" => "Stok hampir habis! Tersisa <20",
                                "other_variant_stock" => "available",
                                "is_limited_stock" => false
                            ]
                        ]
                    ]
                ],
            ],
            'Get Product Variant By Category Id' => [
                'getProductVariantByCategoryId',
                ['cat_id' => 3412],
                null,
                [
                    "header" => [
                        "process_time" => 0,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "category_id" => 3412,
                        "variant_id_combinations" => [
                            [
                                1
                            ],
                            [
                                29
                            ]
                        ],
                        "variant_details" => [
                            [
                                "variant_id" => 1,
                                "has_unit" => 0,
                                "identifier" => "colour",
                                "name" => "Warna",
                                "status" => 2,
                                "units" => [
                                    [
                                        "variant_unit_id" => 0,
                                        "status" => 1,
                                        "unit_name" => "",
                                        "unit_short_name" => "",
                                        "unit_values" => [
                                            [
                                                "variant_unit_value_id" => 1,
                                                "status" => 1,
                                                "value" => "Putih",
                                                "equivalent_value_id" => 1,
                                                "english_value" => "White",
                                                "hex" => "#ffffff",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 2,
                                                "status" => 1,
                                                "value" => "Hitam",
                                                "equivalent_value_id" => 2,
                                                "english_value" => "Black",
                                                "hex" => "#000000",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 5,
                                                "status" => 1,
                                                "value" => "Biru",
                                                "equivalent_value_id" => 5,
                                                "english_value" => "Blue",
                                                "hex" => "#1d6cbb",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 6,
                                                "status" => 1,
                                                "value" => "Biru Muda",
                                                "equivalent_value_id" => 6,
                                                "english_value" => "Light Blue",
                                                "hex" => "#8ad1e8",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 9,
                                                "status" => 1,
                                                "value" => "Merah",
                                                "equivalent_value_id" => 9,
                                                "english_value" => "Red",
                                                "hex" => "#ff0016",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 11,
                                                "status" => 1,
                                                "value" => "Merah Muda",
                                                "equivalent_value_id" => 11,
                                                "english_value" => "Pink",
                                                "hex" => "#ffb0b0",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 12,
                                                "status" => 1,
                                                "value" => "Orange",
                                                "equivalent_value_id" => 12,
                                                "english_value" => "Orange",
                                                "hex" => "#ffa500",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 13,
                                                "status" => 1,
                                                "value" => "Kuning",
                                                "equivalent_value_id" => 13,
                                                "english_value" => "Yellow",
                                                "hex" => "#ffff00",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 16,
                                                "status" => 1,
                                                "value" => "Cokelat",
                                                "equivalent_value_id" => 16,
                                                "english_value" => "Brown",
                                                "hex" => "#8b4513",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 18,
                                                "status" => 1,
                                                "value" => "Hijau",
                                                "equivalent_value_id" => 18,
                                                "english_value" => "Green",
                                                "hex" => "#006400",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 19,
                                                "status" => 1,
                                                "value" => "Ungu",
                                                "equivalent_value_id" => 19,
                                                "english_value" => "Purple",
                                                "hex" => "#bf00ff",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 218,
                                                "status" => 1,
                                                "value" => "Abu-abu",
                                                "equivalent_value_id" => 218,
                                                "english_value" => "Grey",
                                                "hex" => "#5d5d5d",
                                                "icon" => ""
                                            ]
                                        ]
                                    ]
                                ],
                                "is_primary" => 0
                            ],
                            [
                                "variant_id" => 29,
                                "has_unit" => 1,
                                "identifier" => "size",
                                "name" => "Ukuran",
                                "status" => 1,
                                "units" => [
                                    [
                                        "variant_unit_id" => 27,
                                        "status" => 1,
                                        "unit_name" => "Default",
                                        "unit_short_name" => "default",
                                        "unit_values" => [
                                            [
                                                "variant_unit_value_id" => 445,
                                                "status" => 1,
                                                "value" => "0",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 446,
                                                "status" => 1,
                                                "value" => "2",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 447,
                                                "status" => 1,
                                                "value" => "4",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 448,
                                                "status" => 1,
                                                "value" => "6",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 449,
                                                "status" => 1,
                                                "value" => "8",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 450,
                                                "status" => 1,
                                                "value" => "10",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 451,
                                                "status" => 1,
                                                "value" => "12",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 452,
                                                "status" => 1,
                                                "value" => "14",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 453,
                                                "status" => 1,
                                                "value" => "16",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 454,
                                                "status" => 1,
                                                "value" => "XS",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 455,
                                                "status" => 1,
                                                "value" => "S",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 456,
                                                "status" => 1,
                                                "value" => "M",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 457,
                                                "status" => 1,
                                                "value" => "L",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 458,
                                                "status" => 1,
                                                "value" => "XL",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 459,
                                                "status" => 1,
                                                "value" => "XXL",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ],
                                            [
                                                "variant_unit_value_id" => 460,
                                                "status" => 1,
                                                "value" => "All Size",
                                                "equivalent_value_id" => 0,
                                                "english_value" => "",
                                                "hex" => "",
                                                "icon" => ""
                                            ]
                                        ]
                                    ]
                                ],
                                "is_primary" => 0
                            ]
                        ]
                    ]
                ]
            ],
            'Create Product V2' => [
                'createProductV2',
                ['shop_id' => 479573],
                [
                    [
                        "Name" => "Product Testing V2 1.10",
                        "condition" => "NEW",
                        "Description" => "Product Testing Descr V2",
                        "sku" => "TST21",
                        "price" => 10000,
                        "status" => "LIMITED",
                        "stock" => 900,
                        "min_order" => 1,
                        "category_id" => 1817,
                        "price_currency" => "IDR",
                        "weight" => 200,
                        "weight_unit" => "GR",
                        "is_free_return" => false,
                        "is_must_insurance" => false,
                        "etalase" => [
                            "id" => 1402956
                        ],
                        "pictures" => [
                            [
                                "file_path" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2017/9/27/5510391/5510391_9968635e-a6f4-446a-84d0-ff3a98a5d4a2.jpg"
                            ]
                        ],
                        "wholesale" => [
                            [
                                "min_qty" => 2,
                                "price" => 9500
                            ],
                            [
                                "min_qty" => 3,
                                "price" => 9000
                            ]
                        ],
                        "preorder" => [
                            "is_active" => true,
                            "duration" => 5,
                            "time_unit" => "DAY"
                        ],
                        "videos" => [
                            [
                                "source" => "youtube",
                                "url" => "3T9DAOQIUDo"
                            ]
                        ]
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 0.404528676,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "upload_id" => 5721
                    ]
                ]
            ],
            'Create Product V3' => [
                'createProductV3',
                ['shop_id' => 479573],
                [
                    [
                        "Name" => "Product Testing V3 1.36",
                        "condition" => "NEW",
                        "Description" => "Product Testing Descr V2",
                        "sku" => "TST21",
                        "price" => 10000,
                        "status" => "LIMITED",
                        "stock" => 900,
                        "min_order" => 1,
                        "category_id" => 562,
                        "dimension" => [
                            "height" => 2,
                            "width" => 3,
                            "length" => 4
                        ],
                        "custom_product_logistics" => [
                            24,
                            4,
                            64
                        ],
                        "annotations" => [
                            "1"
                        ],
                        "price_currency" => "IDR",
                        "weight" => 200,
                        "weight_unit" => "GR",
                        "is_free_return" => false,
                        "is_must_insurance" => false,
                        "etalase" => [
                            "id" => 1402922
                        ],
                        "pictures" => [
                            [
                                "file_path" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2017/9/27/5510391/5510391_9968635e-a6f4-446a-84d0-ff3a98a5d4a2.jpg"
                            ]
                        ],
                        "wholesale" => [
                            [
                                "min_qty" => 2,
                                "price" => 9500
                            ],
                            [
                                "min_qty" => 3,
                                "price" => 9000
                            ]
                        ]
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 1.054341405,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "total_data" => 1,
                        "success_data" => 1,
                        "fail_data" => 0,
                        "success_rows_data" => [
                            [
                                "product_id" => 2147732129
                            ]
                        ]
                    ]
                ]
            ],
            'Edit Product V2' => [
                'editProductV2',
                ['shop_id' => 479573],
                [
                    "products" => [
                        [
                            "id" => 15347575,
                            "sku" => "TST21",
                            "Name" => "Product Testing V2 1.10",
                            "condition" => "NEW",
                            "Description" => "Product Testing Descr V2",
                            "price" => 10000,
                            "status" => "LIMITED",
                            "stock" => 900,
                            "min_order" => 1,
                            "category_id" => 1817,
                            "price_currency" => "IDR",
                            "weight" => 200,
                            "weight_unit" => "GR",
                            "is_free_return" => false,
                            "is_must_insurance" => false,
                            "etalase" => [
                                "id" => 1402956
                            ],
                            "pictures" => [
                                [
                                    "file_path" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2017/9/27/5510391/5510391_9968635e-a6f4-446a-84d0-ff3a98a5d4a2.jpg"
                                ]
                            ],
                            "wholesale" => [
                                [
                                    "min_qty" => 2,
                                    "price" => 9500
                                ],
                                [
                                    "min_qty" => 3,
                                    "price" => 9000
                                ]
                            ],
                            "preorder" => [
                                "is_active" => true,
                                "duration" => 5,
                                "time_unit" => "DAY"
                            ],
                            "videos" => [
                                [
                                    "source" => "youtube",
                                    "url" => "3T9DAOQIUDo"
                                ]
                            ],
                            "variant" => [
                                "products" => [
                                    [
                                        "is_primary" => true,
                                        "status" => "LIMITED",
                                        "price" => 10000,
                                        "stock" => 500,
                                        "sku" => "TST21",
                                        "combination" => [
                                            0
                                        ],
                                        "pictures" => [
                                            [
                                                "file_path" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2017/9/27/5510391/5510391_9968635e-a6f4-446a-84d0-ff3a98a5d4a2.jpg"
                                            ]
                                        ]
                                    ],
                                    [
                                        "status" => "LIMITED",
                                        "price" => 10000,
                                        "stock" => 400,
                                        "sku" => "TST21",
                                        "combination" => [
                                            1
                                        ],
                                        "pictures" => [
                                            [
                                                "file_path" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2017/9/27/5510391/5510391_9968635e-a6f4-446a-84d0-ff3a98a5d4a2.jpg"
                                            ]
                                        ]
                                    ]
                                ],
                                "selection" => [
                                    [
                                        "id" => 6,
                                        "unit_id" => 7,
                                        "options" => [
                                            [
                                                "hex_code" => "",
                                                "unit_value_id" => 23,
                                                "value" => "XS"
                                            ],
                                            [
                                                "hex_code" => "",
                                                "unit_value_id" => 24,
                                                "value" => "S"
                                            ]
                                        ]
                                    ]
                                ],
                                "sizecharts" => [
                                    [
                                        "file_path" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2017/9/27/5510391/5510391_9968635e-a6f4-446a-84d0-ff3a98a5d4a2.jpg"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 3.945634896,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "upload_id" => 5721
                    ]
                ]
            ],
            'Edit Product V3' => [
                'editProductV3',
                ['shop_id' => 479573],
                [
                    "products" => [
                        [
                            "id" => 1,
                            "Name" => "Product Testing V3 1.40",
                            "condition" => "NEW",
                            "Description" => "Product Testing Descr V2",
                            "sku" => "TST21",
                            "price" => 10000,
                            "status" => "LIMITED",
                            "stock" => 900,
                            "min_order" => 1,
                            "category_id" => 562,
                            "dimension" => [
                                "height" => 2,
                                "width" => 3,
                                "length" => 4
                            ],
                            "custom_product_logistics" => [
                                24,
                                4,
                                64
                            ],
                            "annotations" => [
                                "1"
                            ],
                            "price_currency" => "IDR",
                            "weight" => 200,
                            "weight_unit" => "GR",
                            "is_free_return" => false,
                            "is_must_insurance" => false,
                            "menu" => [
                                "id" => 1402922
                            ],
                            "pictures" => [
                                [
                                    "file_path" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2017/9/27/5510391/5510391_9968635e-a6f4-446a-84d0-ff3a98a5d4a2.jpg"
                                ]
                            ],
                            "wholesale" => [
                                [
                                    "min_qty" => 2,
                                    "price" => 9500
                                ],
                                [
                                    "min_qty" => 3,
                                    "price" => 9000
                                ]
                            ],
                            "variant" => [
                                "products" => [
                                    [
                                        "is_primary" => true,
                                        "status" => "LIMITED",
                                        "price" => 10000,
                                        "stock" => 500,
                                        "sku" => "TST21",
                                        "combination" => [
                                            0
                                        ],
                                        "pictures" => [
                                            [
                                                "file_path" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2017/9/27/5510391/5510391_9968635e-a6f4-446a-84d0-ff3a98a5d4a2.jpg"
                                            ]
                                        ]
                                    ],
                                    [
                                        "status" => "LIMITED",
                                        "price" => 10000,
                                        "stock" => 400,
                                        "sku" => "TST21",
                                        "combination" => [
                                            1
                                        ],
                                        "pictures" => [
                                            [
                                                "file_path" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2017/9/27/5510391/5510391_9968635e-a6f4-446a-84d0-ff3a98a5d4a2.jpg"
                                            ]
                                        ]
                                    ]
                                ],
                                "selection" => [
                                    [
                                        "id" => 6,
                                        "unit_id" => 7,
                                        "options" => [
                                            [
                                                "hex_code" => "",
                                                "unit_value_id" => 23,
                                                "value" => "XS"
                                            ],
                                            [
                                                "hex_code" => "",
                                                "unit_value_id" => 24,
                                                "value" => "S"
                                            ]
                                        ]
                                    ]
                                ],
                                "sizecharts" => [
                                    [
                                        "file_path" => "https://ecs7.tokopedia.net/img/cache/700/product-1/2017/9/27/5510391/5510391_9968635e-a6f4-446a-84d0-ff3a98a5d4a2.jpg"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ], [
                    "header" => [
                        "process_time" => 0,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "total_data" => 1,
                        "success_data" => 1,
                        "fail_data" => 0,
                        "success_rows_data" => [
                            [
                                "product_id" => 1,
                                "product_sku" => "TST21"
                            ]
                        ]
                    ]
                ]
            ],
            'Set Active Product' => [
                'setActiveProduct',
                ['shop_id' => 479573],
                [
                    "product_id" => [
                        15362375,
                        15306196
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 0.588856684,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "total_data" => 2,
                        "succeed_rows" => 2,
                        "failed_rows" => 0,
                        "failed_rows_data" => null
                    ]
                ]
            ],
            'Set Inactive Product' => [
                'setInactiveProduct',
                ['shop_id' => 479573],
                [
                    "product_id" => [
                        15362375,
                        15306196
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 0.588856684,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "total_data" => 2,
                        "succeed_rows" => 2,
                        "failed_rows" => 0,
                        "failed_rows_data" => null
                    ]
                ]
            ],
            'Update Price Only' => [
                'updatePriceOnly',
                ['shop_id' => 479573],
                [
                    [
                        "sku" => "YS1234",
                        "new_price" => 10000
                    ],
                    [
                        "sku" => "ABC1234",
                        "new_price" => 12000
                    ],
                    [
                        "product_id" => 15123699,
                        "new_price" => 12000
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 0.045122173,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "failed_rows" => 0,
                        "failed_rows_data" => [],
                        "succeed_rows" => 3
                    ]
                ]
            ],
            'Update Stok Overwrite' => [
                'updateStockOverwrite',
                ['shop_id' => 479573],
                [
                    [
                        "sku" => "YS1234",
                        "new_stock" => 20
                    ],
                    [
                        "sku" => "ABC1234",
                        "new_stock" => 30
                    ],
                    [
                        "product_id" => 15123699,
                        "new_stock" => 40
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 0.045122173,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "failed_rows" => 0,
                        "failed_rows_data" => [],
                        "succeed_rows" => 3
                    ]
                ]
            ],
            'Update Stock Increment' => [
                'updateStockIncrement',
                ['shop_id' => 479573],
                [
                    [
                        "sku" => "YS1234",
                        "stock_value" => 20
                    ],
                    [
                        "sku" => "ABC1234",
                        "stock_value" => 30
                    ],
                    [
                        "product_id" => 15123699,
                        "stock_value" => 40
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 0,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "total_data" => 2,
                        "succeed_rows" => 2,
                        "succeed_rows_data" => [
                            [
                                "productID" => 15531932,
                                "warehouseID" => 1610,
                                "shopID" => 479573,
                                "stock" => 15,
                                "price" => 10000
                            ],
                            [
                                "productID" => 15485704,
                                "warehouseID" => 1610,
                                "shopID" => 479573,
                                "stock" => 45,
                                "price" => 10000
                            ]
                        ],
                        "failed_rows" => 0,
                        "failed_rows_data" => null
                    ]
                ]
            ],
            'Update Stock Decrement' => [
                'updateStockDecrement',
                ['shop_id' => 479573],
                [
                    [
                        "product_id" => 15531932,
                        "stock_value" => 10
                    ],
                    [
                        "product_id" => 15485704,
                        "stock_value" => 10
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 0,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "total_data" => 2,
                        "succeed_rows" => 2,
                        "succeed_rows_data" => [
                            [
                                "productID" => 15531932,
                                "warehouseID" => 1610,
                                "shopID" => 479573,
                                "stock" => 15,
                                "price" => 10000
                            ],
                            [
                                "productID" => 15485704,
                                "warehouseID" => 1610,
                                "shopID" => 479573,
                                "stock" => 45,
                                "price" => 10000
                            ]
                        ],
                        "failed_rows" => 0,
                        "failed_rows_data" => null
                    ]
                ],

            ],
            'Delete Product' => [
                'deleteProduct',
                ['shop_id' => 479573],
                [
                    "product_id" => [
                        15362375
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 0.588856684,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "total_data" => 1,
                        "succeed_rows" => 1,
                        "failed_rows" => 0,
                        "failed_rows_data" => null
                    ]
                ]
            ],
            'Get All Discussion Product' => [
                'getAllDiscussionProduct',
                ['shop_id' => 481154, 'product_id' => 15425363, 'page' => 1, 'per_page' => 5],
                null,
                [
                    "header" => [
                        "process_time" => 2.18E-7,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "HasNext" => false,
                        "TotalQuestion" => 4,
                        "Question" => [
                            [
                                "Content" => "Terima kasih!",
                                "MaskedContent" => "",
                                "UserName" => "Mohamad",
                                "UserID" => 9068784,
                                "CreateTime" => "2020-12-04T13:40:19Z",
                                "CreateTimeFormatted" => "4 Des",
                                "TotalAnswer" => 2,
                                "Answer" => [
                                    [
                                        "Content" => "sama sama kkak",
                                        "MaskedContent" => "",
                                        "UserName" => "Jualskillcuy",
                                        "UserThumbnail" => "https://ecs7.tokopedia.net/img/cache/215-square/shops-1/2019/10/24/481154/481154_f7355c1f-a110-4bc9-a827-6ce21974116f.png",
                                        "UserID" => 8970523,
                                        "CreateTime" => "2020-12-04T14:14:44Z",
                                        "CreateTimeFormatted" => "4 Des",
                                        "AttachedProduct" => null,
                                        "LikeCount" => 0,
                                        "AnswerID" => 214897552,
                                        "IsSeller" => true
                                    ],
                                    [
                                        "Content" => "Yang ini gimana
                 ?",
                                        "MaskedContent" => "",
                                        "UserName" => "Jualskillcuy",
                                        "UserThumbnail" => "https://ecs7.tokopedia.net/img/cache/215-square/shops-1/2019/10/24/481154/481154_f7355c1f-a110-4bc9-a827-6ce21974116f.png",
                                        "UserID" => 8970523,
                                        "CreateTime" => "2020-12-04T16:16:47Z",
                                        "CreateTimeFormatted" => "4 Des",
                                        "AttachedProduct" => [
                                            [
                                                "ProductID" => 15372491,
                                                "Name" => "Health Master - merah",
                                                "PriceFormatted" => "Rp 10.000",
                                                "URL" => "https://staging.tokopedia.com/jualskillcuy/health-master-merah",
                                                "Thumbnail" => "https://ecs7.tokopedia.net/img/cache/100-square/product-1/2020/4/30/481154/481154_05db8ad1-00ca-48b1-a1aa-b69fc0a10b99.jpg"
                                            ]
                                        ],
                                        "LikeCount" => 0,
                                        "AnswerID" => 214897555,
                                        "IsSeller" => true
                                    ]
                                ],
                                "QuestionID" => 100830289,
                                "AnswererThumbnail" => null,
                                "UserThumbnail" => "https://accounts-staging.tokopedia.com/image/v1/u/9068784/user_thumbnail/desktop"
                            ],
                            [
                                "Content" => "Bisa dikirim hari ini ga?",
                                "MaskedContent" => "",
                                "UserName" => "Mohamad",
                                "UserID" => 9068784,
                                "CreateTime" => "2020-12-04T13:40:15Z",
                                "CreateTimeFormatted" => "4 Des",
                                "TotalAnswer" => 0,
                                "Answer" => [],
                                "QuestionID" => 100830288,
                                "AnswererThumbnail" => null,
                                "UserThumbnail" => "https://accounts-staging.tokopedia.com/image/v1/u/9068784/user_thumbnail/desktop"
                            ],
                            [
                                "Content" => "Hai, barang ini ready ga?",
                                "MaskedContent" => "",
                                "UserName" => "Mohamad",
                                "UserID" => 9068784,
                                "CreateTime" => "2020-12-04T13:40:11Z",
                                "CreateTimeFormatted" => "4 Des",
                                "TotalAnswer" => 1,
                                "Answer" => [
                                    [
                                        "Content" => "Habis kak",
                                        "MaskedContent" => "",
                                        "UserName" => "Jualskillcuy",
                                        "UserThumbnail" => "https://ecs7.tokopedia.net/img/cache/215-square/shops-1/2019/10/24/481154/481154_f7355c1f-a110-4bc9-a827-6ce21974116f.png",
                                        "UserID" => 8970523,
                                        "CreateTime" => "2020-12-08T11:15:10Z",
                                        "CreateTimeFormatted" => "8 Des",
                                        "AttachedProduct" => null,
                                        "LikeCount" => 0,
                                        "AnswerID" => 214897634,
                                        "IsSeller" => true
                                    ]
                                ],
                                "QuestionID" => 100830287,
                                "AnswererThumbnail" => null,
                                "UserThumbnail" => "https://accounts-staging.tokopedia.com/image/v1/u/9068784/user_thumbnail/desktop"
                            ],
                            [
                                "Content" => "Bisa dikirim hari ini ga?",
                                "MaskedContent" => "",
                                "UserName" => "Mohamad",
                                "UserID" => 9068784,
                                "CreateTime" => "2020-12-04T13:39:20Z",
                                "CreateTimeFormatted" => "4 Des",
                                "TotalAnswer" => 2,
                                "Answer" => [
                                    [
                                        "Content" => "ini yang bisa pak",
                                        "MaskedContent" => "",
                                        "UserName" => "Jualskillcuy",
                                        "UserThumbnail" => "https://ecs7.tokopedia.net/img/cache/215-square/shops-1/2019/10/24/481154/481154_f7355c1f-a110-4bc9-a827-6ce21974116f.png",
                                        "UserID" => 8970523,
                                        "CreateTime" => "2020-12-04T16:45:31Z",
                                        "CreateTimeFormatted" => "4 Des",
                                        "AttachedProduct" => [
                                            [
                                                "ProductID" => 15373326,
                                                "Name" => "Beauty Master v3 - merah",
                                                "PriceFormatted" => "Rp 10.000",
                                                "URL" => "https://staging.tokopedia.com/jualskillcuy/beauty-master-v3-merah",
                                                "Thumbnail" => "https://ecs7.tokopedia.net/img/cache/100-square/product-1/2020/5/6/481154/481154_4469e224-7653-458b-b40e-39274a1b499c.jpg"
                                            ]
                                        ],
                                        "LikeCount" => 0,
                                        "AnswerID" => 214897557,
                                        "IsSeller" => true
                                    ],
                                    [
                                        "Content" => "yang ini juga bisa sih",
                                        "MaskedContent" => "",
                                        "UserName" => "Jualskillcuy",
                                        "UserThumbnail" => "https://ecs7.tokopedia.net/img/cache/215-square/shops-1/2019/10/24/481154/481154_f7355c1f-a110-4bc9-a827-6ce21974116f.png",
                                        "UserID" => 8970523,
                                        "CreateTime" => "2020-12-08T09:09:10Z",
                                        "CreateTimeFormatted" => "8 Des",
                                        "AttachedProduct" => [
                                            [
                                                "ProductID" => 15373326,
                                                "Name" => "Beauty Master v3 - merah",
                                                "PriceFormatted" => "Rp 10.000",
                                                "URL" => "https://staging.tokopedia.com/jualskillcuy/beauty-master-v3-merah",
                                                "Thumbnail" => "https://ecs7.tokopedia.net/img/cache/100-square/product-1/2020/5/6/481154/481154_4469e224-7653-458b-b40e-39274a1b499c.jpg"
                                            ],
                                            [
                                                "ProductID" => 15373331,
                                                "Name" => "Beauty Master v4 - biru muda, 2",
                                                "PriceFormatted" => "Rp 10.000",
                                                "URL" => "https://staging.tokopedia.com/jualskillcuy/beauty-master-v4-biru-muda-2",
                                                "Thumbnail" => "https://ecs7.tokopedia.net/img/cache/100-square/product-1/2020/5/6/481154/481154_b9fb2d6c-eb3e-4ea7-93f2-9767149ae314.jpg"
                                            ],
                                            [
                                                "ProductID" => 15372491,
                                                "Name" => "Health Master - merah",
                                                "PriceFormatted" => "Rp 10.000",
                                                "URL" => "https://staging.tokopedia.com/jualskillcuy/health-master-merah",
                                                "Thumbnail" => "https://ecs7.tokopedia.net/img/cache/100-square/product-1/2020/4/30/481154/481154_05db8ad1-00ca-48b1-a1aa-b69fc0a10b99.jpg"
                                            ]
                                        ],
                                        "LikeCount" => 0,
                                        "AnswerID" => 214897631,
                                        "IsSeller" => true
                                    ]
                                ],
                                "QuestionID" => 100830286,
                                "AnswererThumbnail" => null,
                                "UserThumbnail" => "https://accounts-staging.tokopedia.com/image/v1/u/9068784/user_thumbnail/desktop"
                            ]
                        ],
                        "ProductID" => 15425363,
                        "ShopID" => 481154,
                        "ShopURL" => "https://staging.tokopedia.com/jualskillcuy"
                    ]
                ]
            ],
            'Get Product Annotation by Category ID' => [
                'getProductAnnotationByCategoryId',
                ['cat_id' => 1809],
                null,
                [
                    "header" => [
                        "process_time" => 0.139554335,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        [
                            "variant" => "Pola Produk",
                            "sort_order" => 2,
                            "values" => [
                                [
                                    "id" => 84,
                                    "Name" => "Polkadot",
                                    "data" => ""
                                ],
                                [
                                    "id" => 92,
                                    "Name" => "Polos",
                                    "data" => ""
                                ]
                            ]
                        ],
                        [
                            "variant" => "Product Color",
                            "sort_order" => 3,
                            "values" => [
                                [
                                    "id" => 65,
                                    "Name" => "Hitam",
                                    "data" => "#000000"
                                ]
                            ]
                        ],
                        [
                            "variant" => "Product Color",
                            "sort_order" => 3,
                            "values" => [
                                [
                                    "id" => 64,
                                    "Name" => "Beige",
                                    "data" => "#ebcca3"
                                ],
                                [
                                    "id" => 68,
                                    "Name" => "Emas",
                                    "data" => "#ffd700"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
