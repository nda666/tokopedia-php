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
class FinanceTest extends TestCase
{
    use TokopediaTrait;

    public function testGetSaldoHistory()
    {
        $expected =  [
            "header" => [
                "process_time" => 0.016533477,
                "messages" => "Your request has been processed successfully"
            ],
            "data" => [
                "have_next_page" => false,
                "saldo_history" => [
                    [
                        "deposit_id" => 9200019404,
                        "type_description" => "Disbursement to Seller Marketplace",
                        "Type" => 1001,
                        "class" => "Transaction",
                        "amount" => 4000,
                        "note" => "Transaksi Penjualan Berhasil - INV/20201208/XX/XII/42978",
                        "create_time" => "2020-12-08 13:33:56",
                        "withdrawal_date" => "",
                        "withdrawal_status" => 0,
                        "saldo" => 0,
                        "image" => "https://ecs7.tokopedia.net/img/saldo/transaction.png"
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
        $responseData = $tokopedia->finance()
            ->getSaldoHistory(6549744, [
                'page' => 1,
                'per_page' => 10,
                'from_date' => '2020-12-01',
                'to_date' => '2021-01-01'
            ]);

        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals(json_decode(json_encode($expected)), $responseData->getData());
    }
}
