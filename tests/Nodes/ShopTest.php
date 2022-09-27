<?php

namespace TokopediaPhp\Tests\Nodes;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use TokopediaPhp\Tests\ClientTrait;
use TokopediaPhp\Tests\TokopediaTrait;

/**
 * @category Test for Order Node
 * @package  test
 * @author   Adha Bakhtiar <adhabakhtiar@gmail.com>
 * @license  MIT
 * @link     https://github.com/nda666/tokopedia-php
 */
class ShopTest extends TestCase
{
    use TokopediaTrait;

    /**
     * @dataProvider casesProvider
     * @group shop
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
        $responseData = $body ?
            $client->shop()->{$node}($params, $body) :
            $client->shop()->{$node}($params);


        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals(json_decode(json_encode($expected)), $responseData->getData());
    }

    public function casesProvider(): array
    {

        return [
            'Get Shop Info' => [
                'getShopInfo',
                ['page' => 1, 'per_page' => 10],
                null,
                [
                    "header" => [
                        "process_time" => 0,
                        "messages" => "Successfully get retrieved shop info data",
                        "reason" => "",
                        "error_code" => 0
                    ],
                    "data" => [
                        [
                            "shop_id" => 481154,
                            "user_id" => 8970523,
                            "shop_name" => "dumiesshop",
                            "logo" => "https://images.tokopedia.net/img/cache/215-square/shops-1/2019/10/24/481154/481154_f7355c1f-a110-4bc9-a827-6ce21974116f.png",
                            "shop_url" => "https://tokopedia.com/dumiesshop",
                            "is_open" => 1,
                            "status" => 1,
                            "date_shop_created" => "2019-09-24",
                            "domain" => "dumiesshop",
                            "admin_id" => [
                                8970523
                            ],
                            "reason" => "",
                            "district_id" => 1723,
                            "province_name" => "Jawa Barat",
                            "warehouses" => [
                                [
                                    "warehouse_id" => 19689,
                                    "partner_id" => [
                                        "Int64" => 0,
                                        "Valid" => false
                                    ],
                                    "shop_id" => [
                                        "Int64" => 481154,
                                        "Valid" => true
                                    ],
                                    "warehouse_name" => "Shop Location",
                                    "district_id" => 1723,
                                    "district_name" => "Cibinong",
                                    "city_id" => 151,
                                    "city_name" => "Kab. Bogor",
                                    "province_id" => 12,
                                    "province_name" => "Jawa Barat",
                                    "status" => 1,
                                    "postal_code" => "16911",
                                    "is_default" => 1,
                                    "latlon" => "-6.474478443906435,106.8313251228692",
                                    "latitude" => "-6.474478443906435",
                                    "longitude" => "106.8313251228692",
                                    "email" => "",
                                    "address_detail" => "Cibinong Jalan Cipayung Barat",
                                    "phone" => "",
                                    "warehose_type" => "Default Shop Location"
                                ],
                                [
                                    "warehouse_id" => 341600,
                                    "partner_id" => [
                                        "Int64" => 0,
                                        "Valid" => false
                                    ],
                                    "shop_id" => [
                                        "Int64" => 481154,
                                        "Valid" => true
                                    ],
                                    "warehouse_name" => "Pekalongan tiga",
                                    "district_id" => 2629,
                                    "district_name" => "Doro",
                                    "city_id" => 197,
                                    "city_name" => "Kab. Pekalongan",
                                    "province_id" => 14,
                                    "province_name" => "Jawa Tengah",
                                    "status" => 1,
                                    "postal_code" => "51191",
                                    "is_default" => 0,
                                    "latlon" => "-7.020987227618663,109.68869545141341",
                                    "latitude" => "-7.020987227618663",
                                    "longitude" => "109.68869545141341",
                                    "email" => "marcondolx@gmail.com",
                                    "address_detail" => "Jalan mana aja yah yang penting ada",
                                    "phone" => "087877433666",
                                    "warehose_type" => "Shop Location"
                                ],
                                [
                                    "warehouse_id" => 341466,
                                    "partner_id" => [
                                        "Int64" => 0,
                                        "Valid" => false
                                    ],
                                    "shop_id" => [
                                        "Int64" => 481154,
                                        "Valid" => true
                                    ],
                                    "warehouse_name" => "Citayam 12",
                                    "district_id" => 2230,
                                    "district_name" => "Cimanggis",
                                    "city_id" => 171,
                                    "city_name" => "Kota Depok",
                                    "province_id" => 12,
                                    "province_name" => "Jawa Barat",
                                    "status" => 1,
                                    "postal_code" => "16451",
                                    "is_default" => 0,
                                    "latlon" => "-6.366106487752489,106.84127410855234",
                                    "latitude" => "-6.366106487752489",
                                    "longitude" => "106.84127410855234",
                                    "email" => "didit_guys@yahoo.com",
                                    "address_detail" => "Jalan Jauhh",
                                    "phone" => "087877433666",
                                    "warehose_type" => "Shop Location"
                                ],
                                [
                                    "warehouse_id" => 340937,
                                    "partner_id" => [
                                        "Int64" => 33,
                                        "Valid" => true
                                    ],
                                    "shop_id" => [
                                        "Int64" => 0,
                                        "Valid" => false
                                    ],
                                    "warehouse_name" => "Depok Raya",
                                    "district_id" => 2229,
                                    "district_name" => "Beji",
                                    "city_id" => 171,
                                    "city_name" => "Kota Depok",
                                    "province_id" => 12,
                                    "province_name" => "Jawa Barat",
                                    "status" => 1,
                                    "postal_code" => "16424",
                                    "is_default" => 0,
                                    "latlon" => "",
                                    "latitude" => "",
                                    "longitude" => "",
                                    "email" => "marcondolx@gmail.com",
                                    "address_detail" => "Jalan mana aja yah yang penting ada",
                                    "phone" => "087877433666",
                                    "warehose_type" => "Tokocabang"
                                ]
                            ],
                            "subscribe_tokocabang" => false
                        ]
                    ]
                ]
            ],
            'Update Shop Status' => [
                'updateShopStatus',
                [
                    "shop_id" => 1707045,
                    "action" => "open",
                    "start_date" => "20191015",
                    "end_date" => "20191017",
                    "close_note" => "Toko Ditutup Sementara",
                    "close_now" => false
                ],
                null,
                [
                    "header" => [
                        "process_time" => 0.090246203,
                        "messages" => "Successfully Update Shop Status",
                        "reason" => "",
                        "error_code" => 200
                    ],
                    "data" => [
                        "header" => [
                            "process_time" => 0.021940634,
                            "Messages" => null,
                            "reason" => "",
                            "error_code" => "200"
                        ],
                        "data" => "Berhasil memperbarui Status Toko"
                    ]
                ]
            ],
            'Get All Etalase' => [
                'getAllEtalase',
                ['shop_id' => 479573],
                null,
                [
                    "header" => [
                        "process_time" => 1.24278336,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "shop" => [
                            "id" => 479573,
                            "Name" => "I`nti.Cosmetic",
                            "uri" => "https://staging.tokopedia.com/icl",
                            "location" => "DKI Jakarta"
                        ],
                        "etalase" => [
                            [
                                "etalase_id" => 1402956,
                                "etalase_name" => "Jangan Dihapus Jangan Di Edit",
                                "url" => "https://staging.tokopedia.com/icl/etalase/jangan-dihapus-jangan-di-edit"
                            ],
                            [
                                "etalase_id" => 1401474,
                                "etalase_name" => "Coloring",
                                "url" => "https://staging.tokopedia.com/icl/etalase/coloring"
                            ],
                            [
                                "etalase_id" => 1401475,
                                "etalase_name" => "Writing",
                                "url" => "https://staging.tokopedia.com/icl/etalase/writing"
                            ]
                        ]
                    ]
                ]
            ],
            'Get Showcase' => [
                'getShowcase',
                ['shop_id' => 479573],
                null,
                [
                    "header" => [
                        "process_time" => 0.153555533,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "showcase" => [
                            [
                                "id" => 1420235,
                                "Name" => "testshowcase2",
                                "alias" => "testshowcase2",
                                "uri" => "https://staging.tokopedia.com/progamer/etalase/testshowcase2",
                                "product_count" => 0,
                                "is_highlighted" => false,
                                "badge" => "",
                                "ace_default_sort" => 0
                            ]
                        ],
                        "showcase_group" => [
                            [
                                "id" => 2,
                                "Name" => "Semua Produk",
                                "alias" => "etalase",
                                "uri" => "https://staging.tokopedia.com/progamer",
                                "product_count" => 0,
                                "is_highlighted" => false,
                                "badge" => "",
                                "ace_default_sort" => 0
                            ],
                            [
                                "id" => 3,
                                "Name" => "Produk Terjual",
                                "alias" => "sold",
                                "uri" => "https://staging.tokopedia.com/progamer/sold?sort=7",
                                "product_count" => 0,
                                "is_highlighted" => false,
                                "badge" => "",
                                "ace_default_sort" => 14
                            ]
                        ],
                        "use_ace" => false,
                        "showcase_without_ace" => [
                            4,
                            5
                        ],
                        "prev_link" => "progamer/v1/shop/showcase?display=all&hide_no_count=false&p=1&take=10",
                        "next_link" => "progamer/v1/shop/showcase?display=all&hide_no_count=false&p=2&take=10"
                    ]
                ]
            ],

            'Create Showcase' => [
                'createShowcase',
                ['shop_id' => 479573],
                ["name" => "testshowcase"],
                [
                    "header" => [
                        "process_time" => 0.509604864,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "message" => "Berhasil menambah Etalase Toko",
                        "created_id" => 1420235
                    ]
                ]
            ],
            'Update Showcase' => [
                'updateShowcase',
                ['shop_id' => 479573],
                ["name" => "testshowcase", "id" => 27927217],
                [
                    "header" => [
                        "process_time" => 0.509604864,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "message" => "Berhasil memperbarui Etalase Toko"
                    ]
                ]
            ],
            'Delete Showcase' => [
                'deleteShowcase',
                ['shop_id' => 479573],
                ["id" => 27927217],
                [
                    "header" => [
                        "process_time" => 0.509604864,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "message" => "Berhasil menghapus Etalase Toko"
                    ]
                ]
            ]
        ];
    }
}
