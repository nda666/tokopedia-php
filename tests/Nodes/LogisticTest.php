<?php

namespace TokopediaPhp\Tests\Nodes;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use TokopediaPhp\Tests\ClientTrait;
use TokopediaPhp\Tests\TokopediaTrait;

/**
 * @category Test for Logistic Node
 * @package  test
 * @author   Adha Bakhtiar <adhabakhtiar@gmail.com>
 * @license  MIT
 * @link    https://github.com/nda666/tokopedia-php
 */
class LogisticTest extends TestCase
{
    use TokopediaTrait;

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
        $responseData = $body ? $client->logistic()->$node($params, $body) : $client->logistic()->$node($params);


        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals(json_decode(json_encode($expected)), $responseData->getData());
    }

    public function casesProvider(): array
    {

        return [
            'Get Active Courier' => [
                'getActiveCourier',
                ['shop_id' => 479573],
                null,
                [
                    'header' => [
                        'process_time' => 0,
                        'messages' => 'Your request has been processed successfully',
                    ],
                    'data' => [
                        'Shops' => [
                            0 => [
                                'ShopID' => 479573,
                                'ShipmentInfos' => [
                                    0 => [
                                        'ShipmentID' => 1,
                                        'ShipmentName' => 'JNE',
                                        'ShipmentCode' => 'jne',
                                        'ShipmentAvailable' => 1,
                                        'ShipmentImage' => 'https://ecs7.tokopedia.net/img/kurir-jne.png',
                                        'ShipmentPackages' => [
                                            0 => [
                                                'IsAvailable' => 1,
                                                'ProductName' => 'Reguler',
                                                'ShippingProductID' => 1,
                                            ],
                                            1 => [
                                                'IsAvailable' => 1,
                                                'ProductName' => 'YES',
                                                'ShippingProductID' => 6,
                                            ],
                                        ],
                                        'AWBStatus' => 1,
                                    ],
                                    1 => [
                                        'ShipmentID' => 2,
                                        'ShipmentName' => 'TIKI',
                                        'ShipmentCode' => 'tiki',
                                        'ShipmentAvailable' => 1,
                                        'ShipmentImage' => 'https://ecs7.tokopedia.net/img/kurir-tiki.png',
                                        'ShipmentPackages' => [
                                            0 => [
                                                'IsAvailable' => 1,
                                                'ProductName' => 'Reguler',
                                                'ShippingProductID' => 3,
                                            ],
                                            1 => [
                                                'IsAvailable' => 1,
                                                'ProductName' => 'Over Night Service',
                                                'ShippingProductID' => 16,
                                            ],
                                        ],
                                    ],
                                    2 => [
                                        'ShipmentID' => 11,
                                        'ShipmentName' => 'SiCepat',
                                        'ShipmentCode' => 'sicepat',
                                        'ShipmentAvailable' => 1,
                                        'ShipmentImage' => 'https://ecs7.tokopedia.net/img/kurir-sicepat.png',
                                        'ShipmentPackages' => [
                                            0 => [
                                                'IsAvailable' => 1,
                                                'ProductName' => 'Regular Package',
                                                'ShippingProductID' => 18,
                                            ],
                                            1 => [
                                                'IsAvailable' => 1,
                                                'ProductName' => 'BEST',
                                                'ShippingProductID' => 33,
                                            ],
                                            2 => [
                                                'IsAvailable' => 1,
                                                'ProductName' => 'GOKIL',
                                                'ShippingProductID' => 43,
                                            ],
                                            3 => [
                                                'IsAvailable' => 1,
                                                'ProductName' => 'Regular Package',
                                                'ShippingProductID' => 44,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
            ],
            'Get Shipment Info' => [
                'getShipmentInfo',
                ['shop_id' => 479573],
                null,
                [
                    'header' => [
                        'process_time' => 0,
                        'messages' => 'success',
                        'reason' => '',
                        'error_code' => 0,
                    ],
                    'data' => [
                        0 => [
                            'shipper_id' => 1,
                            'shipper_name' => 'JNE',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-jne.png',
                            'services' => [
                                0 => [
                                    'service_id' => 1,
                                    'service_name' => 'Reguler',
                                    'service_desc' => 'JNE Reguler adalah paket reguler yang ditawarkan JNE. Kecepatan pengiriman tergantung dari lokasi pengiriman dan lokasi tujuan. Untuk kota yang sama, umumnya memakan waktu 2-3 hari.',
                                ],
                                1 => [
                                    'service_id' => 2,
                                    'service_name' => 'OKE',
                                    'service_desc' => 'JNE OKE adalah paket ekonomis yang ditawarkan JNE. Umumnya pengiriman melalui paket ini membutuhkan waktu yang lebih lama. Dukungan kota nya pun masih terbatas.',
                                ],
                                2 => [
                                    'service_id' => 6,
                                    'service_name' => 'YES',
                                    'service_desc' => 'JNE YES adalah paket dengan prioritas pengiriman tercepat yang ditawarkan JNE. Hanya saja perlu diperhatikan kecepatan barang diterima juga dipengaruhi oleh kecepatan penjual melakukan pengiriman barang.',
                                ],
                            ],
                        ],
                        1 => [
                            'shipper_id' => 2,
                            'shipper_name' => 'TIKI',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-tiki.png',
                            'services' => [
                                0 => [
                                    'service_id' => 3,
                                    'service_name' => 'Reguler',
                                    'service_desc' => 'TIKI Paket Reguler adalah paket yang dapat menjangkau seluruh Indonesia hanya dalam waktu kurang dari 7 hari kerja.',
                                ],
                                1 => [
                                    'service_id' => 16,
                                    'service_name' => 'Over Night Service',
                                    'service_desc' => 'ONS (Over Night Services) Hari ini paket Anda kami kirimkan dan paket akan segera tiba keesokan harinya.',
                                ],
                            ],
                        ],
                        2 => [
                            'shipper_id' => 4,
                            'shipper_name' => 'Pos Indonesia',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-pos.png',
                            'services' => [
                                0 => [
                                    'service_id' => 10,
                                    'service_name' => 'Pos Kilat Khusus',
                                    'service_desc' => 'Gunakan Pos Kilat Khusus, sebagai pilihan tepat untuk pengiriman Suratpos yang mengandalkan kecepatan kiriman dan menjangkau ke seluruh pelosok Indonesia.',
                                ],
                            ],
                        ],
                        3 => [
                            'shipper_id' => 6,
                            'shipper_name' => 'Wahana',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-wahana.png',
                            'services' => [
                                0 => [
                                    'service_id' => 8,
                                    'service_name' => 'Service Normal',
                                    'service_desc' => 'Service Normal adalah pengiriman paket yang ditawarkan Wahana ke seluruh kota besar Indonesia dengan lead time pengiriman estimasi 3-4 hari untuk kota besar propinsi dan +10 hari untuk kota kabupaten sesuai kecamatan yang dituju.',
                                ],
                            ],
                        ],
                        4 => [
                            'shipper_id' => 10,
                            'shipper_name' => 'GO-JEK',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-gosend.png',
                            'services' => [
                                0 => [
                                    'service_id' => 28,
                                    'service_name' => 'Instant Courier',
                                    'service_desc' => 'Layanan pengiriman instan dengan durasi pengiriman beberapa jam saja (3 jam) sejak serah terima paket ke kurir.',
                                ],
                                1 => [
                                    'service_id' => 20,
                                    'service_name' => 'Same Day',
                                    'service_desc' => 'Layanan pengiriman dengan durasi pengiriman beberapa jam (6 jam) sejak serah terima paket ke kurir dan akan sampai di hari yang sama.',
                                ],
                            ],
                        ],
                        5 => [
                            'shipper_id' => 11,
                            'shipper_name' => 'SiCepat',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-sicepat.png',
                            'services' => [
                                0 => [
                                    'service_id' => 44,
                                    'service_name' => 'REG',
                                    'service_desc' => 'Sicepat Reg Sampai',
                                ],
                                1 => [
                                    'service_id' => 18,
                                    'service_name' => 'Regular Package',
                                    'service_desc' => 'Layanan Pengiriman biasa dengan lead time 1-2 hari (kota besar) dan lead time 3-4 hari (Kabupaten/transit)',
                                ],
                                2 => [
                                    'service_id' => 33,
                                    'service_name' => 'BEST',
                                    'service_desc' => 'BEST (Besok Sampai Tujuan): Layanan Pengiriman Express dengan lead time 1 hari',
                                ],
                                3 => [
                                    'service_id' => 43,
                                    'service_name' => 'Cargo',
                                    'service_desc' => 'Layanan pengiriman standard dengan kecepatan pengiriman 3-8 hari tergantung rute pengiriman. Harga lebih murah/ ekonomis dan berskala besar (bulk shipment) dengan durasi pengiriman yang lebih lama karena menggunakan jalur darat.',
                                ],
                            ],
                        ],
                        6 => [
                            'shipper_id' => 12,
                            'shipper_name' => 'Ninja Xpress',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-ninja.png',
                            'services' => [
                                0 => [
                                    'service_id' => 25,
                                    'service_name' => 'Reguler',
                                    'service_desc' => 'Layanan pengiriman standard dengan kecepatan pengiriman tergantung dari lokasi pengiriman dan lokasi tujuan. Umumnya 2-4 hari/ 5-9 hari/ >9 hari tergantung rute pengiriman.',
                                ],
                            ],
                        ],
                        7 => [
                            'shipper_id' => 13,
                            'shipper_name' => 'Grab',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-grab.png',
                            'services' => [
                                0 => [
                                    'service_id' => 37,
                                    'service_name' => 'Instant',
                                    'service_desc' => 'Layanan pengiriman instan dengan durasi pengiriman beberapa jam saja (3 jam) sejak serah terima paket ke kurir.',
                                ],
                                1 => [
                                    'service_id' => 24,
                                    'service_name' => 'Same Day',
                                    'service_desc' => 'Layanan pengiriman dengan durasi pengiriman beberapa jam (6 jam) sejak serah terima paket ke kurir dan akan sampai di hari yang sama.',
                                ],
                            ],
                        ],
                        8 => [
                            'shipper_id' => 14,
                            'shipper_name' => 'J&T',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-jnt.png',
                            'services' => [
                                0 => [
                                    'service_id' => 27,
                                    'service_name' => 'Reguler',
                                    'service_desc' => 'J&T Express adalah layanan ekspres pertama di Indonesia berbasis teknologi, memberikan kemudahan dalam satu layanan.',
                                ],
                            ],
                        ],
                        9 => [
                            'shipper_id' => 16,
                            'shipper_name' => 'REX',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-rex.png',
                            'services' => [
                                0 => [
                                    'service_id' => 32,
                                    'service_name' => 'REX-10',
                                    'service_desc' => 'Layanan pengiriman standard dengan kecepatan pengiriman 3-8 hari tergantung rute pengiriman. Harga lebih murah/ ekonomis dan berskala besar (bulk shipment) dengan durasi pengiriman yang lebih lama karena menggunakan jalur darat.',
                                ],
                            ],
                        ],
                        10 => [
                            'shipper_id' => 23,
                            'shipper_name' => 'AnterAja',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-anteraja.png',
                            'services' => [
                                0 => [
                                    'service_id' => 45,
                                    'service_name' => 'Reguler',
                                    'service_desc' => 'Layanan pengiriman standard dengan kecepatan pengiriman tergantung dari lokasi pengiriman dan lokasi tujuan. Umumnya 2-4 hari/ 5-9 hari/ >9 hari tergantung rute pengiriman.',
                                ],
                                1 => [
                                    'service_id' => 46,
                                    'service_name' => 'Next Day',
                                    'service_desc' => 'Layanan pengiriman express dengan durasi pengiriman 1 hari dihitung sejak serah terima paket ke kurir.',
                                ],
                                2 => [
                                    'service_id' => 49,
                                    'service_name' => 'Same Day',
                                    'service_desc' => 'Layanan AnterAja Same Day',
                                ],
                            ],
                        ],
                        11 => [
                            'shipper_id' => 24,
                            'shipper_name' => 'Lion Parcel',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-lionparcel.png',
                            'services' => [
                                0 => [
                                    'service_id' => 47,
                                    'service_name' => 'Reguler',
                                    'service_desc' => 'Layanan pengiriman standard dengan kecepatan pengiriman tergantung dari lokasi pengiriman dan lokasi tujuan. Umumnya 2-4 hari/ 5-9 hari/ >9 hari tergantung rute pengiriman.',
                                ],
                            ],
                        ],
                        12 => [
                            'shipper_id' => 25,
                            'shipper_name' => 'Indo Paket',
                            'services' => [
                                0 => [
                                    'service_id' => 48,
                                    'service_name' => 'reguler',
                                    'service_desc' => 'Layanan Reguler Indo Paket',
                                ],
                            ],
                        ],
                        13 => [
                            'shipper_id' => 999,
                            'shipper_name' => 'Custom Logistik',
                            'logo' => 'https://ecs7.tokopedia.net/img/kurir-custom.png',
                            'services' => [
                                0 => [
                                    'service_id' => 999,
                                    'service_name' => 'Service Normal',
                                    'service_desc' => 'Service Normal adalah pengiriman paket yang ditawarkan Official Store menggunakan logistik toko.',
                                ],
                            ],
                        ],
                    ],
                ]
            ],
            'Update Shipment Info' => [
                'updateShipmentInfo',
                ['shop_id' => 479573],
                [
                    1 => [
                        6 => 0,
                    ],
                    23 => [
                        45 => 1,
                    ],
                ],
                [
                    'header' => [
                        'process_time' => 0,
                        'messages' => 'success',
                        'reason' => '',
                        'error_code' => 0,
                    ],
                    'data' => [
                        'status' => 'OK',
                        'server_process_time' => '0.089585',
                        'message_status' => [
                            0 => 'Anda telah sukses memperbaharui informasi pengiriman.',
                        ],
                        'data' => [
                            'success' => true,
                        ],
                    ],
                ]
            ]
        ];
    }
}
