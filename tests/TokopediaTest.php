<?php

namespace TokopediaPhp\Tests;

use PHPUnit\Framework\TestCase;
use TokopediaPhp\Nodes\Finance;
use TokopediaPhp\Nodes\Interaction;
use TokopediaPhp\Nodes\Logistic;
use TokopediaPhp\Nodes\Order;
use TokopediaPhp\Nodes\Product;
use TokopediaPhp\Nodes\Shop;

class TokopediaTest extends TestCase
{
    use TokopediaTrait;

    public function getNodeCases()
    {

        return [
            'logistic' => [
                'logistic',
                Logistic::class,
            ],
            'finance' => [
                'finance',
                Finance::class,
            ],
            'interaction' => [
                'interaction',
                Interaction::class,
            ],
            'order' => [
                'order',
                Order::class,
            ],
            'product' => [
                'product',
                Product::class,
            ],
            'shop' => [
                'shop',
                Shop::class,
            ],
        ];
    }

    /**
     * @dataProvider getNodeCases
     * @param string $node
     * @param string $expected
     */
    public function testNodes($node, $expected)
    {
        $tokopedia = $this->createClient([]);
        // $this->assertNotNull($tokopedia->{$node}());
        $this->assertInstanceOf($expected, $tokopedia->{$node}());
    }
}
