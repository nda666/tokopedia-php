<?php

namespace TokopediaPhp\Interfaces;

interface EncryptionInterface
{
    /**
     * If you want to upload or update public key yourself you can use this endpoint below
     * @link https://developer.tokopedia.com/openapi/guide/guides/encryption/register-public-key
     * @param string $publicKeyPath
     * @return \TokopediaPhp\ResponseData
     */
    public function registerPublicKey($publicKeyPath);
}
