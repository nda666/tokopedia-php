<?php

namespace TokopediaPhp\Nodes;

use TokopediaPhp\Interfaces\IpWhitelistInterface;
use TokopediaPhp\NodeAbstract;

class IpWhitelist extends NodeAbstract implements IpWhitelistInterface
{
    public function getRegisterIp()
    {
        return $this->get("v1/fs/:fs_id/whitelist");
    }
}
