<?php

namespace TokopediaPhp\Nodes;

use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Utils;
use TokopediaPhp\Interfaces\EncryptionInterface;
use TokopediaPhp\NodeAbstract;

class Encryption extends NodeAbstract implements EncryptionInterface
{
    public function registerPublicKey($publicKeyPath)
    {
        return $this->post(
            '/v1/fs/:fs_id/register',
            ['upload' => 1],
            new MultipartStream([
                [
                    'name' => 'public_key',
                    'contents' => Utils::tryFopen($publicKeyPath, 'r'),
                ]
            ])
        );
    }
}
