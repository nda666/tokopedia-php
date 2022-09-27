<?php

namespace TokopediaPhp;

use TokopediaPhp\Tokopedia;
use Psr\Http\Message\UriInterface;

abstract class NodeAbstract
{
    /**
     * @var \TokopediaPhp\Client
     */
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param  string|UriInterface $uri
     * @param  array               $requestParameters
     * @return \TokopediaPhp\ResponseData
     */
    protected function post($uri, $requestParameters = [], $requestBody = [], $headers = [])
    {

        $request = $this->client->request('POST', $uri, $requestParameters, $requestBody, $headers);
        $response = $this->client->send($request);

        return new ResponseData($response);
    }

    /**
     * @param  string|UriInterface $uri
     * @param  array               $requestParameters
     * @return \TokopediaPhp\ResponseData
     */
    protected function patch($uri, $requestParameters = [], $requestBody = [], $headers = [])
    {
        $request = $this->client->request('PATCH', $uri, $requestParameters, $requestBody, $headers);
        $response = $this->client->send($request);

        return new ResponseData($response);
    }

    /**
     * @param  string|UriInterface $uri
     * @param  array               $requestParameters
     * @return ResponseData
     */
    protected function get($uri, $requestParameters = [], $headers = [])
    {

        $request = $this->client->request('GET', $uri, $requestParameters, [], $headers = []);
        $response = $this->client->send($request);

        return new ResponseData($response);
    }
}
