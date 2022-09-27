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
class CategoryTest extends TestCase
{
    use TokopediaTrait;

    public function testGetAllCategories()
    {
        $expected =  [
            "header" => [
                "process_time" => 0.184012578,
                "messages" => "",
                "reason" => "",
                "error_code" => 0
            ],
            "data" => [
                "categories" => [
                    [
                        "Name" => "Fashion Wanita",
                        "id" => "1758",
                        "child" => [
                            [
                                "Name" => "Atasan",
                                "id" => "1768",
                                "child" => [
                                    [
                                        "Name" => "Polo Shirt",
                                        "id" => "1774"
                                    ],
                                    [
                                        "Name" => "Blouse",
                                        "id" => "1771"
                                    ],
                                    [
                                        "Name" => "Kaos",
                                        "id" => "1769"
                                    ],
                                    [
                                        "Name" => "Kemeja",
                                        "id" => "1770"
                                    ],
                                    [
                                        "Name" => "Tank Top",
                                        "id" => "1772"
                                    ],
                                    [
                                        "Name" => "Crop Top",
                                        "id" => "1773"
                                    ]
                                ]
                            ],
                            [
                                "Name" => "Celana",
                                "id" => "1775",
                                "child" => [
                                    [
                                        "Name" => "Legging",
                                        "id" => "1781"
                                    ],
                                    [
                                        "Name" => "Celana Crop",
                                        "id" => "1779"
                                    ],
                                    [
                                        "Name" => "Hot Pants",
                                        "id" => "1776"
                                    ],
                                    [
                                        "Name" => "Celana Jeans",
                                        "id" => "1778"
                                    ],
                                    [
                                        "Name" => "Celana Panjang",
                                        "id" => "1780"
                                    ],
                                    [
                                        "Name" => "Celana Pendek",
                                        "id" => "1777"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];


        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode($expected)
        );


        /** @var \TokopediaPhp\Tokopedia $tokopedia */
        $tokopedia = $this->createClient([
            'fsId' => 13004
        ], $this->createHttpClient($response));


        /** @var \TokopediaPhp\ResponseData $responseData */
        $responseData = $tokopedia->category()
            ->getAllCategories([
                'keyword' => 'Tas Sekolah Anak',
            ]);

        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals(json_decode(json_encode($expected)), $responseData->getData());
    }
}
