<?php

namespace TokopediaPhp\Exception\Api;

use GuzzleHttp\Exception\RequestException;

class Factory
{
    /**
     * Create api exception
     *
     * @param string $className
     * @param \GuzzleHttp\Exception\RequestException $exception
     * @return \TokopediaPhp\Exception\Api\ApiException
     */
    public static function create($className, $exception)
    {
        return new $className(
            $exception->getMessage(),
            $exception->getRequest(),
            $exception->getResponse(),
            $exception,
            $exception->getHandlerContext()
        );
    }
}
