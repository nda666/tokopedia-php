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
class IpWhitelistTest extends TestCase
{
    use TokopediaTrait;

    public function testGetRegisterIp()
    {
        $expected =   [
            "header" => [
                "process_time" => 0.017376506,
                "messages" => "Your request has been processed successfully"
            ],
            "data" => [
                "fs_id" => 13138,
                "ip_whitelisted" => [
                    "202.80.212.75",
                    "5.37.157.153",
                    "156.113.224.183",
                    "203.46.239.137"
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
            'fsId' => 13398
        ], $this->createHttpClient($response));

        /** @var \TokopediaPhp\ResponseData $responseData */
        $responseData = $tokopedia->ipWhitelist()->getRegisterIp();

        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals(json_decode(json_encode($expected)), $responseData->getData());
    }
}
