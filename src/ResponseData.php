<?php

namespace TokopediaPhp;

use Psr\Http\Message\ResponseInterface;

use function json_decode;

class ResponseData
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;

    /**
     * @var object
     */
    private $data;

    public function __construct(ResponseInterface $response)
    {
        $contents = $response->getBody()->getContents();
        $contentTypes = $response->getHeader('Content-Type');
        $contentType = isset($contentTypes[0]) ? $contentTypes[0] : null;

        $data = strtolower($contentType) == 'application/json' ? json_decode($contents) : $contents;

        $this->response = $response;
        $this->data = $data;
    }

    /**
     * Get response
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get data
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
