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
class OrderTest extends TestCase
{
    use TokopediaTrait;

    public function testGetShippingLabel()
    {
        $expected = '<html><body>Some HTML Page</body></html>';
        $response = new Response(200, ['content-type' => 'text/html'], $expected);

        $history = [];

        /** @var \TokopediaPhp\Tokopedia $tokopedia */
        $tokopedia = $this->createClient([
            'fsId' => 13004
        ], $this->createHttpClient($response, $history));

        /** @var ResponseData $responseData */
        $responseData = $tokopedia->order()->getShippingLabel(123123, [
            "printed" => 0
        ]);


        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals($expected, $responseData->getData());
    }
    public function testRequestPickUp()
    {
        $expected =  [
            "header" => [
                "process_time" => 0.06721941,
                "messages" => "Your request has been processed successfully"
            ],
            "data" => [
                "order_id" => 180745398,
                "shop_id" => 1707045,
                "request_time" => "2018-06-12 10:24:00",
                "result" => "Terima kasih telah melakukan pengiriman."
            ]
        ];
        $response = new Response(200, ['content-type' => 'application/json'], json_encode($expected));

        $history = [];

        /** @var \TokopediaPhp\Tokopedia $tokopedia */
        $tokopedia = $this->createClient([
            'fsId' => 13004
        ], $this->createHttpClient($response, $history));

        /** @var ResponseData $responseData */
        $responseData = $tokopedia->order()->requestPickUp([
            "order_id" => 180745398,
            "shop_id" => 1707045
        ]);


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
        $responseData = $body ?
            $client->order()->{$node}($params, $body) :
            $client->order()->{$node}($params);


        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals(json_decode(json_encode($expected)), $responseData->getData());
    }

    public function casesProvider(): array
    {

        return [
            'Get All Orders' => [
                'getAllOrders',
                [
                    'fs_id' => 13004,
                    'shop_id' => 479573,
                    'from_date' => 1491623331,
                    'to_date' => 1554695331,
                    'page' => 1,
                    'per_page' => 1
                ],
                null,
                [
                    "header" => [
                        "process_time" => 0.018328845,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        [
                            "fs_id" => "13004",
                            "order_id" => 43481289,
                            "is_cod_mitra" => false,
                            "accept_partial" => false,
                            "invoice_ref_num" => "INV/20200110/XX/I/502",
                            "have_product_bundle" => true,
                            "products" => [
                                [
                                    "id" => 2147967676,
                                    "Name" => "TEST BARANG",
                                    "quantity" => 4,
                                    "notes" => "",
                                    "weight" => 0.1,
                                    "total_weight" => 0.4,
                                    "price" => 10000,
                                    "total_price" => 40000,
                                    "currency" => "Rp",
                                    "sku" => "",
                                    "is_wholesale" => false
                                ],
                                [
                                    "id" => 2147967676,
                                    "Name" => "TEST BARANG",
                                    "quantity" => 1,
                                    "notes" => "",
                                    "weight" => 0.1,
                                    "total_weight" => 0.1,
                                    "price" => 100000,
                                    "total_price" => 100000,
                                    "currency" => "Rp",
                                    "sku" => "",
                                    "is_wholesale" => false
                                ]
                            ],
                            "products_fulfilled" => [
                                [
                                    "product_id" => 2147967676,
                                    "quantity_deliver" => 4,
                                    "quantity_reject" => 0
                                ],
                                [
                                    "product_id" => 2147967676,
                                    "quantity_deliver" => 1,
                                    "quantity_reject" => 0
                                ]
                            ],
                            "bundle_detail" => [
                                "bundle" => [
                                    [
                                        "bundle_id" => 8925,
                                        "bundle_variant_id" => "bid:8925-pid:2147967676-pid1:2147967676",
                                        "bundle_name" => "Paket Murah",
                                        "bundle_price" => 40000,
                                        "bundle_quantity" => 1,
                                        "bundle_subtotal_price" => 40000,
                                        "order_detail" => [
                                            [
                                                "order_dtl_id" => 20627504,
                                                "order_id" => 167046488,
                                                "product_id" => 2147967676,
                                                "product_name" => "TEST BARANG",
                                                "product_desc" => "",
                                                "quantity" => 4,
                                                "product_price" => 10000,
                                                "product_weight" => 0.1,
                                                "total_weight" => 0.4,
                                                "subtotal_price" => 40000,
                                                "notes" => "",
                                                "finsurance" => 1,
                                                "returnable" => 0,
                                                "child_cat_id" => 0,
                                                "currency_id" => 1,
                                                "insurance_price" => 0,
                                                "normal_price" => 100000,
                                                "currency_rate" => 1,
                                                "prod_pic" => '[{"file_name":"cf50e595-6d09-43b6-8043-1a75df4d2910.jpg","file_path":"hDjmkQ/2021/11/12","status":2}]',
                                                "min_order" => 4,
                                                "must_insurance" => 0,
                                                "condition" => 1,
                                                "campaign_id" => 0,
                                                "sku" => "",
                                                "is_slash_price" => false,
                                                "oms_detail_data" => "",
                                                "thumbnail" => "https://ecs7.tokopedia.net/img/cache/100-square/hDjmkQ/2021/11/12/cf50e595-6d09-43b6-8043-1a75df4d2910.jpg",
                                                "bundle_id" => 8925,
                                                "bundle_variant_id" => "bid:8925-pid:2147967676-pid1:2147967676"
                                            ]
                                        ]
                                    ]
                                ],
                                "non_bundle" => [
                                    [
                                        "order_dtl_id" => 20627505,
                                        "order_id" => 167046488,
                                        "product_id" => 2147967676,
                                        "product_name" => "TEST BARANG",
                                        "product_desc" => "",
                                        "quantity" => 1,
                                        "product_price" => 100000,
                                        "product_weight" => 0.1,
                                        "total_weight" => 0.1,
                                        "subtotal_price" => 100000,
                                        "notes" => "",
                                        "finsurance" => 1,
                                        "returnable" => 0,
                                        "child_cat_id" => 0,
                                        "currency_id" => 1,
                                        "insurance_price" => 0,
                                        "normal_price" => 100000,
                                        "currency_rate" => 1,
                                        "prod_pic" => '[{"file_name":"cf50e595-6d09-43b6-8043-1a75df4d2910.jpg","file_path":"hDjmkQ/2021/11/12","status":2}]',
                                        "min_order" => 0,
                                        "must_insurance" => 0,
                                        "condition" => 1,
                                        "campaign_id" => 0,
                                        "sku" => "",
                                        "is_slash_price" => false,
                                        "oms_detail_data" => "",
                                        "thumbnail" => "https://ecs7.tokopedia.net/img/cache/100-square/hDjmkQ/2021/11/12/cf50e595-6d09-43b6-8043-1a75df4d2910.jpg"
                                    ]
                                ],
                                "total_product" => 1
                            ],
                            "device_type" => "",
                            "buyer" => [
                                "id" => 8970588,
                                "Name" => "Mitra Test Account",
                                "phone" => "62888888888",
                                "email" => "mitra_test@tokopedia.com"
                            ],
                            "shop_id" => 479066,
                            "payment_id" => 11687315,
                            "recipient" => [
                                "Name" => "Mitra Test Account",
                                "phone" => "62888888888",
                                "address" => [
                                    "address_full" => "Kobakma, Kab. Mamberamo Tengah, Papua, 99558",
                                    "district" => "Kobakma",
                                    "city" => "Kab. Mamberamo Tengah",
                                    "province" => "Papua",
                                    "country" => "Indonesia",
                                    "postal_code" => "99558",
                                    "district_id" => 5455,
                                    "city_id" => 555,
                                    "province_id" => 33,
                                    "geo" => "-3.69624360109313,139.10973580486393"
                                ]
                            ],
                            "logistics" => [
                                "shipping_id" => 999,
                                "district_id" => 0,
                                "city_id" => 0,
                                "province_id" => 0,
                                "geo" => "",
                                "shipping_agency" => "Custom Logistik",
                                "service_type" => "Service Normal"
                            ],
                            "amt" => [
                                "ttl_product_price" => 98784,
                                "shipping_cost" => 10000,
                                "insurance_cost" => 0,
                                "ttl_amount" => 108784,
                                "voucher_amount" => 0,
                                "toppoints_amount" => 0
                            ],
                            "dropshipper_info" => [],
                            "voucher_info" => [
                                "voucher_code" => "",
                                "voucher_type" => 0
                            ],
                            "order_status" => 700,
                            "warehouse_id" => 0,
                            "fulfill_by" => 0,
                            "create_time" => 1578671153,
                            "custom_fields" => [
                                "awb" => "CSDRRRRR502"
                            ],
                            "promo_order_detail" => [
                                "order_id" => 43481289,
                                "total_cashback" => 0,
                                "total_discount" => 20000,
                                "total_discount_product" => 10000,
                                "total_discount_shipping" => 10000,
                                "total_discount_details" => [
                                    [
                                        "amount" => 10000,
                                        "Type" => "discount_product"
                                    ],
                                    [
                                        "amount" => 10000,
                                        "Type" => "discount_shipping"
                                    ]
                                ],
                                "summary_promo" => [
                                    [
                                        "Name" => "Promo Product July",
                                        "is_coupon" => false,
                                        "show_cashback_amount" => true,
                                        "show_discount_amount" => true,
                                        "cashback_amount" => 0,
                                        "cashback_points" => 0,
                                        "Type" => "discount",
                                        "discount_amount" => 10000,
                                        "discount_details" => [
                                            [
                                                "amount" => 10000,
                                                "Type" => "discount_product"
                                            ]
                                        ],
                                        "invoice_desc" => "PRODUCTDISC"
                                    ],
                                    [
                                        "Name" => "Promo Ongkir",
                                        "is_coupon" => false,
                                        "show_cashback_amount" => true,
                                        "show_discount_amount" => true,
                                        "cashback_amount" => 0,
                                        "cashback_points" => 0,
                                        "Type" => "discount",
                                        "discount_amount" => 10000,
                                        "discount_details" => [
                                            [
                                                "amount" => 10000,
                                                "Type" => "discount_shipping"
                                            ]
                                        ],
                                        "invoice_desc" => "ONGKIRFREE"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ],
            'getSingleOrder' => [
                'getSingleOrder',
                ['invoice_num' => 'INV/20170720/XVII/VII/12472252'],
                null,
                [
                    "header" => [
                        "process_time" => 0.149503274,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "order_id" => 12472302,
                        "buyer_id" => 5511917,
                        "seller_id" => 479573,
                        "payment_id" => 11539459,
                        "is_affiliate" => false,
                        "is_fulfillment" => false,
                        "order_warehouse" => [
                            "warehouse_id" => 0,
                            "fulfill_by" => 0,
                            "meta_data" => [
                                "warehouse_id" => 0,
                                "partner_id" => 0,
                                "shop_id" => 0,
                                "warehouse_name" => "",
                                "district_id" => 0,
                                "district_name" => "",
                                "city_id" => 0,
                                "city_name" => "",
                                "province_id" => 0,
                                "province_name" => "",
                                "status" => 0,
                                "postal_code" => "",
                                "is_default" => 0,
                                "latlon" => "",
                                "latitude" => "",
                                "longitude" => "",
                                "email" => "",
                                "address_detail" => "",
                                "country_name" => "",
                                "is_fulfillment" => false
                            ]
                        ],
                        "order_status" => 0,
                        "invoice_number" => "INV/20170720/XVII/VII/12472252",
                        "invoice_pdf" => "Invoice-5511917-479573-20170720175058-WE1NWElRVVk.pdf",
                        "invoice_url" => "https://staging.tokopedia.com/invoice.pl?id=12472302&pdf=Invoice-5511917-479573-20170720175058-WE1NWElRVVk",
                        "open_amt" => 270000,
                        "lp_amt" => 0,
                        "cashback_amt" => 0,
                        "info" => "",
                        "comment" => "* 24/07/2017 08:01:07 : Penjual telah melebihi batas waktu proses pesanan",
                        "item_price" => 261000,
                        "buyer_info" => [
                            "buyer_id" => 5511917,
                            "buyer_fullname" => "Maulana Hasim",
                            "buyer_email" => "maulana.hasim@tokopedia.com",
                            "buyer_phone" => "6287774160644"
                        ],
                        "shop_info" => [
                            "shop_owner_id" => 5510391,
                            "shop_owner_email" => "hana.mahrifah+inti@tokopedia.com",
                            "shop_owner_phone" => "628119916444",
                            "shop_name" => "I`nti.Cosmetic",
                            "shop_domain" => "icl",
                            "shop_id" => 479573
                        ],
                        "shipment_fulfillment" => [
                            "id" => 0,
                            "order_id" => 0,
                            "payment_date_time" => "0001-01-01T00:00:00Z",
                            "is_same_day" => false,
                            "accept_deadline" => "0001-01-01T00:00:00Z",
                            "confirm_shipping_deadline" => "0001-01-01T00:00:00Z",
                            "item_delivered_deadline" => [
                                "Time" => "0001-01-01T00:00:00Z",
                                "Valid" => false
                            ],
                            "is_accepted" => false,
                            "is_confirm_shipping" => false,
                            "is_item_delivered" => false,
                            "fulfillment_status" => 0
                        ],
                        "preorder" => [
                            "order_id" => 0,
                            "preorder_type" => 0,
                            "preorder_process_time" => 0,
                            "preorder_process_start" => "2017-07-20T17:50:58.061156Z",
                            "preorder_deadline" => "0001-01-01T00:00:00Z",
                            "shop_id" => 0,
                            "customer_id" => 0
                        ],
                        "order_info" => [
                            "order_detail" => [
                                [
                                    "order_detail_id" => 20274955,
                                    "product_id" => 14286600,
                                    "product_name" => "STABILO Paket Ballpoint Premium Bionic Rollerball - Multicolor",
                                    "product_desc_pdp" => "Paket
 pulpen premium membuat kegiatan menulis kamu bisa lebih berwarna kenyamanan yang maksimal- memiliki 4 warna Paket
 pulpen premium membuat kegiatan menulis kamu bisa lebih berwarna kenyamanan yang maksimal- memiliki 4 warna",
                                    "product_desc_atc" => "Paket
 pulpen premium membuat kegiatan menulis kamu bisa lebih berwarna kenyamanan yang maksimal- memiliki 4 warna Paket
 pulpen premium membuat kegiatan menulis kamu bisa lebih berwarna kenyamanan yang maksimal- memiliki 4 warna",
                                    "product_price" => 261000,
                                    "subtotal_price" => 261000,
                                    "weight" => 0.2,
                                    "total_weight" => 0.2,
                                    "quantity" => 1,
                                    "quantity_deliver" => 1,
                                    "quantity_reject" => 0,
                                    "is_free_returns" => false,
                                    "insurance_price" => 0,
                                    "normal_price" => 0,
                                    "currency_id" => 2,
                                    "currency_rate" => 0,
                                    "min_order" => 0,
                                    "child_cat_id" => 1122,
                                    "campaign_id" => "",
                                    "product_picture" => "https://imagerouter-staging.tokopedia.com/image/v1/p/14286600/product_detail/desktop",
                                    "snapshot_url" => "https://staging.tokopedia.com/snapshot_product?order_id=12472302&dtl_id=20274955",
                                    "sku" => "SKU01"
                                ]
                            ],
                            "order_history" => [
                                [
                                    "action_by" => "system-automatic",
                                    "hist_status_code" => 0,
                                    "message" => "",
                                    "timestamp" => "2017-07-24T08:01:07.073696Z",
                                    "comment" => "Penjual telah melebihi batas waktu proses pesanan",
                                    "create_by" => 0,
                                    "update_by" => "system"
                                ],
                                [
                                    "action_by" => "buyer",
                                    "hist_status_code" => 220,
                                    "message" => "",
                                    "timestamp" => "2017-07-20T17:50:58.374626Z",
                                    "comment" => "",
                                    "create_by" => 0,
                                    "update_by" => "tokopedia"
                                ],
                                [
                                    "action_by" => "buyer",
                                    "hist_status_code" => 100,
                                    "message" => "",
                                    "timestamp" => "2017-07-20T17:50:58.374626Z",
                                    "comment" => "",
                                    "create_by" => 0,
                                    "update_by" => "system"
                                ]
                            ],
                            "order_age_day" => 812,
                            "shipping_age_day" => 0,
                            "delivered_age_day" => 0,
                            "partial_process" => false,
                            "shipping_info" => [
                                "sp_id" => 1,
                                "shipping_id" => 1,
                                "logistic_name" => "JNE",
                                "logistic_service" => "Reguler",
                                "shipping_price" => 9000,
                                "shipping_price_rate" => 9000,
                                "shipping_fee" => 0,
                                "insurance_price" => 0,
                                "fee" => 0,
                                "is_change_courier" => false,
                                "second_sp_id" => 0,
                                "second_shipping_id" => 0,
                                "second_logistic_name" => "",
                                "second_logistic_service" => "",
                                "second_agency_fee" => 0,
                                "second_insurance" => 0,
                                "second_rate" => 0,
                                "awb" => "",
                                "autoresi_cashless_status" => 0,
                                "autoresi_awb" => "",
                                "autoresi_shipping_price" => 0,
                                "count_awb" => 0,
                                "isCashless" => false,
                                "is_fake_delivery" => false
                            ],
                            "destination" => [
                                "receiver_name" => "maul",
                                "receiver_phone" => "085712345678",
                                "address_street" => "jalan gatot subroto kav 123456789",
                                "address_district" => "Jagakarsa",
                                "address_city" => "Kota Administrasi Jakarta Selatan",
                                "address_province" => "DKI Jakarta",
                                "address_postal" => "123456",
                                "customer_address_id" => 4649619,
                                "district_id" => 2263,
                                "city_id" => 175,
                                "province_id" => 13
                            ],
                            "is_replacement" => false,
                            "replacement_multiplier" => 0
                        ],
                        "origin_info" => [
                            "sender_name" => "I`nti.Cosmetic",
                            "origin_province" => 13,
                            "origin_province_name" => "DKI Jakarta",
                            "origin_city" => 174,
                            "origin_city_name" => "Kota Administrasi Jakarta Barat",
                            "origin_address" => "Jalan Letjen S. Parman, Palmerah, 11410",
                            "origin_district" => 2258,
                            "origin_district_name" => "Palmerah",
                            "origin_postal_code" => "",
                            "origin_geo" => "-6.190449999999999,106.79771419999997",
                            "receiver_name" => "maul",
                            "destination_address" => "jalan gatot subroto kav 123456789",
                            "destination_province" => 13,
                            "destination_city" => 175,
                            "destination_district" => 2263,
                            "destination_postal_code" => "123456",
                            "destination_geo" => ",",
                            "destination_loc" => [
                                "lat" => 0,
                                "lon" => 0
                            ]
                        ],
                        "payment_info" => [
                            "payment_id" => 11539459,
                            "payment_ref_num" => "PYM/20170720/XVII/VII/4999664",
                            "payment_date" => "2017-07-20T17:50:06Z",
                            "payment_method" => 0,
                            "payment_status" => "Verified",
                            "payment_status_id" => 2,
                            "create_time" => "2017-07-20T17:50:06Z",
                            "pg_id" => 12,
                            "gateway_name" => "Installment Payment",
                            "discount_amount" => 0,
                            "voucher_code" => "",
                            "voucher_id" => 0
                        ],
                        "insurance_info" => [
                            "insurance_type" => 0
                        ],
                        "hold_info" => null,
                        "cancel_request_info" => null,
                        "create_time" => "2017-07-20T17:50:58.061156Z",
                        "shipping_date" => null,
                        "update_time" => "2017-07-24T08:01:07.073696Z",
                        "payment_date" => "2017-07-20T17:50:58.061156Z",
                        "delivered_date" => null,
                        "est_shipping_date" => null,
                        "est_delivery_date" => null,
                        "related_invoices" => null,
                        "custom_fields" => null
                    ]
                ]
            ],
            'Accept Order (ACK)' => [
                'acceptOrder',
                12490706,
                null,
                [
                    "header" => [
                        "process_time" => 0.18334048,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => "success"
                ]
            ],
            'Reject Order (NACK)' => [
                'rejectOrder',
                12490706,
                [
                    "reason_code" => 1,
                    "reason" => "out of stock",
                    "shop_close_end_date" => "17/05/2017",
                    "shop_close_note" => "Maaf Pak, shop saya tutup untuk liburan",
                    "empty_products" => [
                        2148038232,
                        2148042339
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 0.18334048,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => "success"
                ]
            ],
            'Update Order Status' => [
                'updateOrderStatus',
                12533254,
                [
                    "order_status" => 500,
                    "shipping_ref_num" => "RESIM4NT413"
                ],
                [
                    "header" => [
                        "process_time" => 0.102536306,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => "success"
                ]
            ],
            'Get Fulfillment Order' => [
                'getFulfillmentOrder',
                [
                    'order_id' => 342026997
                ],
                null,
                [
                    "header" => [
                        "process_time" => "35.50ms",
                        "messages" => null,
                        "reason" => "",
                        "error_code" => ""
                    ],
                    "data" => [
                        "order_data" => [
                            [
                                "order" => [
                                    "order_id" => 342026997,
                                    "buyer_id" => 64565282,
                                    "seller_id" => 2926870,
                                    "payment_id" => 444594306,
                                    "order_status" => 700,
                                    "invoice_number" => "INV/20190718/XIX/VII/341976843",
                                    "invoice_pdf_link" => "pdf/2019/07/18",
                                    "open_amt" => 200000,
                                    "payment_amt_cod" => 195000
                                ],
                                "order_history" => [
                                    [
                                        "order_hist_id" => 2883479110,
                                        "status" => 700,
                                        "shipping_date" => null,
                                        "create_by" => 0
                                    ],
                                    [
                                        "order_hist_id" => 2883478788,
                                        "status" => 690,
                                        "shipping_date" => null,
                                        "create_by" => 0
                                    ]
                                ],
                                "order_detail" => [
                                    [
                                        "order_detail_id" => 540585010,
                                        "product_id" => 375822451,
                                        "product_name" => "",
                                        "quantity" => 1,
                                        "product_price" => 184000,
                                        "insurance_price" => 0
                                    ]
                                ],
                                "drop_shipper" => [
                                    "order_id" => 0,
                                    "dropship_name" => "",
                                    "dropship_telp" => ""
                                ],
                                "type_meta" => [
                                    "kelontong" => [],
                                    "cod" => [],
                                    "sampai" => [],
                                    "now" => [],
                                    "ppp" => [],
                                    "trade_in" => [],
                                    "vehicle_leasing" => []
                                ],
                                "order_shipment_fulfillment" => [
                                    "id" => 121101022,
                                    "order_id" => 342026997,
                                    "payment_date_time" => "2019-07-18T14:58:01.998063Z",
                                    "is_same_day" => false,
                                    "accept_deadline" => "2019-07-19T14:58:01.998063Z",
                                    "confirm_shipping_deadline" => "2019-07-22T14:58:01.998063Z",
                                    "item_delivered_deadline" => [
                                        "Time" => "0001-01-01T00:00:00Z",
                                        "Valid" => false
                                    ],
                                    "is_accepted" => false,
                                    "is_confirm_shipping" => false,
                                    "is_item_delivered" => false,
                                    "fulfillment_status" => 0
                                ],
                                "booking_data" => [
                                    "order_id" => 342026997,
                                    "booking_code" => "000213552920",
                                    "booking_status" => 200
                                ]
                            ]
                        ],
                        "next_order_id" => 342026997,
                        "first_order_id" => 342026997
                    ],
                    "status" => "200"
                ]
            ],
            'Get Resolution Ticket' => [
                'getResolutionTicket',
                [
                    'from_date' => '2021-08-06',
                    'to_date' => '2021-08-31',
                    'shop_id' => '1',
                ],
                null,
                [
                    "header" => [
                        "process_time" => 659,
                        "messages" => "Your request has been processed successfully"
                    ],
                    "data" => [
                        "is_success" => true,
                        "startdate" => "2021-08-24",
                        "enddate" => "2021-08-31",
                        "shops" => [
                            [
                                "shop_id" => 1,
                                "shop_name" => "Test",
                                "ticket" => [
                                    [
                                        "id" => 1,
                                        "problem_type" => "Product broken/not same as description",
                                        "status" => "Finished",
                                        "open_date" => "2021-08-26",
                                        "sla_date" => "2021-08-30",
                                        "close_date" => "2021-08-30",
                                        "invoice_number" => "INV/1/MPL/1",
                                        "solution" => "Refund",
                                        "complaint_product" => [
                                            [
                                                "id" => 1,
                                                "Name" => "Kipas angin super dingin",
                                                "qty" => 1,
                                                "price" => 2000,
                                                "final_price" => 0,
                                                "image" => "test"
                                            ]
                                        ],
                                        "fault" => "Seller",
                                        "shipping_amt" => 0,
                                        "total_issued_funds" => 2000
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]

        ];
    }
}
