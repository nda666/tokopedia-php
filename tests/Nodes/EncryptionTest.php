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
class EncryptionTest extends TestCase
{
    use TokopediaTrait;

    public function testRegisterPublicKey()
    {
        $expected =  [
            "header" => [
                "process_time" => 15,
                "messages" => "Your request has been processed successfully"
            ],
            "data" => null
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
        $responseData = $tokopedia->encryption()
            ->registerPublicKey(__DIR__ . '/../datasets/public_key.txt');

        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals(json_decode(json_encode($expected)), $responseData->getData());
    }
}
