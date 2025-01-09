<?php

namespace TokopediaPhp;

use TokopediaPhp\Nodes\Campaign;
use TokopediaPhp\Nodes\Category;
use TokopediaPhp\Nodes\Encryption;
use TokopediaPhp\Nodes\Finance;
use TokopediaPhp\Nodes\Interaction;
use TokopediaPhp\Nodes\IpWhitelist;
use TokopediaPhp\Nodes\Logistic;
use TokopediaPhp\Nodes\Order;
use TokopediaPhp\Nodes\Product;
use TokopediaPhp\Nodes\Shop;

class Tokopedia
{
    /**
     * @var \TokopediaPhp\Tokopedia
     */
    protected $client;

    /**
     * Undocumented function
     *
     * @param array{
     *  httpClient: null,
     *  baseUrl:'',
     *  userAgent:'',
     *  clientSecret:'',
     *  clientId:'',
     *  fsId:''
     * }
     */
    public function __construct($config = [])
    {
        $this->client = new Client($config);
    }

    /**
     * @return \TokopediaPhp\Interfaces\EncryptionInterface
     */
    public function encryption()
    {
        return new Encryption($this->client);
    }

    /**
     * Order Endpoint
     * @return \TokopediaPhp\Interfaces\LogisticInterface
     */
    public function logistic()
    {
        return new Logistic($this->client);
    }

    /**
     * Order Endpoint
     * @return \TokopediaPhp\Interfaces\InteractionInterface
     */
    public function interaction()
    {
        return new Interaction($this->client);
    }

    /**
     * Order Endpoint
     * @return \TokopediaPhp\Interfaces\OrderInterface
     */
    public function order()
    {
        return new Order($this->client);
    }

    /**
     * Ip Whitelist Endpoint
     * @return \TokopediaPhp\Interfaces\IpWhitelistInterface
     */
    public function ipWhitelist()
    {
        return new IpWhitelist($this->client);
    }

    /**
     * Product Endpoint
     * @return \TokopediaPhp\Interfaces\ProductInterface
     */
    public function product()
    {
        return new Product($this->client);
    }

    /**
     * @return \TokopediaPhp\Interfaces\ShopInterface
     */
    public function shop()
    {
        return new Shop($this->client);
    }

    /**
     * @return \TokopediaPhp\Interfaces\FinanceInterface
     */
    public function finance()
    {
        return new Finance($this->client);
    }

    /**
     * @return \TokopediaPhp\Interfaces\CategoryInterface
     */
    public function category()
    {
        return new Category($this->client);
    }

    /**
     * @return \TokopediaPhp\Interfaces\CampaignInterface
     */
    public function campaign()
    {
        return new Campaign($this->client);
    }
}
