<?php

namespace TokopediaPhp\Nodes;

use TokopediaPhp\Interfaces\FinanceInterface;
use TokopediaPhp\NodeAbstract;

class Finance extends NodeAbstract implements FinanceInterface
{
    public function getSaldoHistory($shopId, $params = [])
    {
        return $this->get("/v1/fs/:fs_id/shop/$shopId/saldo-history", $params);
    }
}
