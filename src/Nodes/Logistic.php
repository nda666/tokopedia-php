<?php

namespace TokopediaPhp\Nodes;

use TokopediaPhp\Interfaces\LogisticInterface;
use TokopediaPhp\NodeAbstract;

class Logistic extends NodeAbstract implements LogisticInterface
{

    public function getShipmentInfo($params = [])
    {
        return $this->get("/v2/logistic/fs/:fs_id/info", $params);
    }

    public function getActiveCourier($params = [])
    {
        return $this->get("/v1/logistic/fs/:fs_id/active-info", $params);
    }

    public function updateShipmentInfo($params = [], $body = [])
    {
        return $this->post('/v2/logistic/fs/:fs_id/update', $params, $body);
    }
}
