<?php

namespace TokopediaPhp\Tests\Nodes;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use TokopediaPhp\Tests\ClientTrait;
use TokopediaPhp\Tests\TokopediaTrait;

/**
 * @category Test for Interaction Node
 * @package  test
 * @author   Adha Bakhtiar <adhabakhtiar@gmail.com>
 * @license  MIT
 * @link    https://github.com/nda666/tokopedia-php
 */
class InteractionTest extends TestCase
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
        $responseData = $body ? $client->interaction()->$node($params, $body) : $client->interaction()->$node($params);


        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals(json_decode(json_encode($expected)), $responseData->getData());
    }

    public function casesProvider(): array
    {

        return [
            'List Message' => [
                'getListMessage',
                ['shop_id' => 234567],
                null,
                [
                    "header" => [
                        "process_time" => 0,
                        "messages" => "success",
                        "reason" => "",
                        "error_code" => 0
                    ],
                    "data" => [
                        [
                            "message_key" => "user-456456~shop-123123",
                            "msg_id" => 123123,
                            "attributes" => [
                                "contact" => [
                                    "id" => 456456,
                                    "role" => "user",
                                    "attributes" => [
                                        "Name" => "Owen",
                                        "tag" => "Pengguna",
                                        "thumbnail" => "https://accounts-staging.tokopedia.com/image/v1/u/456456/user_thumbnail/"
                                    ]
                                ],
                                "last_reply_msg" => "test",
                                "last_reply_time" => 1571646034517,
                                "read_status" => 2,
                                "unreads" => 0,
                                "pin_status" => 0
                            ]
                        ]
                    ]
                ]
            ],
            'List Reply' => [
                'getListReply',
                54321,
                ['shop_id' => 234567],
                [
                    "header" => [
                        "process_time" => 0,
                        "messages" => "success",
                        "reason" => "",
                        "error_code" => 0
                    ],
                    "data" => [
                        [
                            "msg_id" => 54321,
                            "sender_id" => 13579,
                            "role" => "User",
                            "msg" => '<a rel="nofollow" target="_blank" href="https://staging.tokopedia.com/fuados-tiga/test-product">https://staging.tokopedia.com/fuados-tiga/test-product</a>',
                            "reply_time" => 1564741529630,
                            "reply_id" => 98765,
                            "sender_name" => "Owen",
                            "read_status" => 2,
                            "read_time" => 1564741529221,
                            "status" => 1,
                            "attachment_id" => 77777,
                            "message_is_read" => true,
                            "is_opposite" => true,
                            "is_first_reply" => false,
                            "is_reported" => false
                        ]
                    ]
                ]
            ],
            'Initiate Chat' => [
                'getInitiateChat',
                ['order_id' => 1234],
                null,
                [
                    "header" => [
                        "process_time" => 0,
                        "messages" => "success",
                        "reason" => "",
                        "error_code" => 0
                    ],
                    "data" => [
                        "contact" => [
                            "id" => 232323,
                            "role" => "user",
                            "attributes" => [
                                "Name" => "Owen",
                                "tag" => "Pengguna",
                                "thumbnail" => "https://accounts.tokopedia.com/image/v1/u/232323/user_thumbnail/",
                                "is_gold" => false,
                                "is_official" => false
                            ]
                        ],
                        "is_success" => true,
                        "msg_id" => 121212
                    ]
                ]
            ],
            'Send Reply' => [
                'sendReply',
                54321,
                [
                    "shop_id" => 23456,
                    "attachment_type" => 19,
                    "payload" => [
                        "thumbnail" => "https://www.tokopedia.com/quotation_thumbnail.jpg",
                        "identifier" => "string",
                        "title" => "Quotation Card",
                        "price" => "Rp10.000",
                        "url" => "https://www.tokopedia.com/quotation_url"
                    ]
                ],
                [
                    "header" => [
                        "process_time" => 0,
                        "messages" => "success",
                        "reason" => "",
                        "error_code" => 0
                    ],
                    "data" => [
                        "msg_id" => 54321,
                        "sender_id" => 123456,
                        "role" => 2,
                        "reply_time" => 1571626816456,
                        "from" => "Owen",
                        "attachment" => [
                            "quotation_profile" => [
                                "thumbnail" => "https://www.tokopedia.com/quotation_thumbnail.jpg",
                                "identifier" => "string",
                                "title" => "Quotation Card",
                                "price" => "Rp10.000",
                                "url" => "https://www.tokopedia.com/quotation_url"
                            ]
                        ],
                        "fallback_attachment" => [
                            "html" => "<div>https://www.tokopedia.com/quotation_url</div>",
                            "message" => "https://www.tokopedia.com/quotation_url"
                        ]
                    ]
                ]

            ]
        ];
    }
}
