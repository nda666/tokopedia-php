<?php

namespace TokopediaPhp\Interfaces;

interface IpWhitelistInterface
{
    /**
     * You can use this endpoint below to check your IP that whitelisted in Seller API
     * @link https://developer.tokopedia.com/openapi/guide/guides/ip-whitelist/get-ip-whitelist
     * @return \TokopediaPhp\ResponseData
     */
    public function getRegisterIp();
}
