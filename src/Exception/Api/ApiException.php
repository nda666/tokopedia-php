<?php

namespace TokopediaPhp\Exception\Api;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use TokopediaPhp\ResponseData;

class ApiException extends \RuntimeException
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface|null
     */
    private $response;

    /**
     * @var array
     */
    private $context;

    /**
     * @var object
     */
    private $data;

    /**
     * Undocumented function
     *
     * @param string $message
     * @param \Psr\Http\Message\RequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface|null $response
     * @param \Exception|null $previous
     * @param array $context
     */
    public function __construct(
        $message,
        $request,
        $response = null,
        $previous = null,
        $context = []
    ) {
        parent::__construct($message, $response->getStatusCode(), $previous);
        $this->request = $request;
        $this->response = $response;
        $this->context = $context;
        $this->data = (new ResponseData($this->response))->getData();
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }
}
