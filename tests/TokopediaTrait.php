<?php

namespace TokopediaPhp\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client as HttpClient;
use TokopediaPhp\Client;
use TokopediaPhp\Tokopedia;

use function is_array;
use function array_merge;

/**
 * Undocumented trait
 */
trait TokopediaTrait
{
    protected $defaultConfig = [
        'secret' => '42',
        'partner_id' => 1,
        'shopid' => 10000,
    ];

    /**
     * @param  Response|Response[] $responses
     * @param  array|\ArrayAccess  $history
     * @return \GuzzleHttp\HandlerStack
     */
    public function createMockHandler($responses, &$history = [])
    {
        if (!is_array($responses)) {
            $responses = [$responses];
        }

        $handler = HandlerStack::create(new MockHandler($responses));
        $handler->push(Middleware::history($history));

        return $handler;
    }

    /**
     * @param  \GuzzleHttp\Psr7\Response|\GuzzleHttp\Psr7\Response[] $responses
     * @param  array|\ArrayAccess  $history
     * @return \GuzzleHttp\Client`
     */
    public function createHttpClient($responses, &$history = [])
    {
        $httpHandler = $this->createMockHandler($responses, $history);

        return new HttpClient(['handler' => $httpHandler]);
    }

    /**
     * Undocumented function
     *
     * @param array $config
     * @param \GuzzleHttp\Client|null $httpClient
     * @return \TokopediaPhp\Tokopedia
     */
    public function createClient($config = [],  $httpClient = null)
    {
        if ($httpClient !== null) {
            $config['httpClient'] = $httpClient;
        }

        return new Tokopedia(array_merge($this->defaultConfig, $config));
    }
}
