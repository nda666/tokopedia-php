<?php

namespace TokopediaPhp\Nodes;

use TokopediaPhp\Interfaces\OrderInterface;
use TokopediaPhp\NodeAbstract;

class Order extends NodeAbstract implements OrderInterface
{
    public function getAllOrders($params = [])
    {
        return $this->get('/v2/order/list?fs_id=:fs_id', $params);
    }

    public function getFulfillmentOrder($params = [])
    {
        return $this->get("/v1/fs/:fs_id/fulfillment_order", $params);
    }

    public function getSingleOrder($params = [])
    {
        return $this->get("/v2/fs/:fs_id/order", $params);
    }

    public function getShippingLabel($orderId, $params = [])
    {
        return $this->get("/v1/order/$orderId/fs/:fs_id/shipping-label", $params);
    }

    public function acceptOrder($orderId)
    {
        return $this->post("/v1/order/$orderId/fs/:fs_id/ack");
    }

    public function rejectOrder($orderId, $body = [])
    {
        return $this->post("/v1/order/$orderId/fs/:fs_id/nack", [], $body);
    }

    public function updateOrderStatus($orderId, $body = [])
    {
        return $this->post("/v1/order/$orderId/fs/:fs_id/status", [], $body);
    }

    public function requestPickUp($body = [])
    {
        return $this->post("/resolution/v1/fs/:fs_id/ticket", [], $body);
    }

    public function getResolutionTicket($params = [])
    {
        return $this->get("/resolution/v1/fs/:fs_id/ticket", $params);
    }
}
