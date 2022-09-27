<?php

namespace TokopediaPhp\Nodes;

use TokopediaPhp\Interfaces\ShopInterface;
use TokopediaPhp\NodeAbstract;

class Shop extends NodeAbstract implements ShopInterface
{
    public function getShopInfo($params = [])
    {
        return $this->get('/v1/shop/fs/:fs_id/shop-info', $params);
    }

    public function updateShopStatus($body = [])
    {
        return $this->post('/v2/shop/fs/:fs_id/shop-status', [], $body);
    }

    public function getAllEtalase($params = [])
    {
        return $this->get('/inventory/v1/fs/:fs_id/product/etalase', $params);
    }

    public function getShowcase($params = [])
    {
        return $this->get('/v1/showcase/fs/:fs_id/get', $params);
    }

    public function createShowcase($params = [], $body = [])
    {
        return $this->post('/v1/showcase/fs/:fs_id/create', $params, $body);
    }

    public function updateShowcase($params = [], $body = [])
    {
        return $this->patch('/v1/showcase/fs/:fs_id/update', $params, $body);
    }

    public function deleteShowcase($params = [], $body = [])
    {
        return $this->post('/v1/showcase/fs/:fs_id/delete', $params, $body);
    }
}
