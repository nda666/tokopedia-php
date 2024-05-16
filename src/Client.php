<?php

namespace TokopediaPhp;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as ExceptionClientException;
use GuzzleHttp\Exception\ServerException as ExceptionServerException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils;
use kamermans\OAuth2\GrantType\ClientCredentials;
use kamermans\OAuth2\GrantType\RefreshToken;
use kamermans\OAuth2\OAuth2Middleware;
use kamermans\OAuth2\Persistence\Laravel5CacheTokenPersistence;
use TokopediaPhp\Exception\Api\AuthException;
use TokopediaPhp\Exception\Api\BadRequestException;
use TokopediaPhp\Exception\Api\ClientException;
use TokopediaPhp\Exception\Api\Factory;
use TokopediaPhp\Exception\Api\ServerException;
use TokopediaPhp\Exception\Api\TooManyRequestException;

class Client
{
    protected const VERSION = '0.1.0';

    public const DEFAULT_BASE_URL = 'https://fs.tokopedia.net';

    public const DEFAULT_USER_AGENT = 'tokopedia-php/' . self::VERSION;

    protected const MAX_RETRIES = 1;

    protected const ENV_FS_ID_NAME = 'TOKOPEDIA_FS_ID';

    protected const ENV_SECRET_NAME = 'TOKOPEDIA_CLIENT_SECRET';

    protected const ENV_CLIENT_ID_NAME = 'TOKOPEDIA_CLIENT_ID';

    /**
     * @var \Psr\Http\Message\RequestInterface
     */
    protected $currentRequest;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient;

    /**
     * @var \Psr\Http\Message\UriInterface
     */
    protected $baseUrl;

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var string|int
     */
    protected $fsId;

    /**
     * @var string|int
     */
    protected $clientId;

    /**
     * @var string|int
     */
    protected $clientSecret;

    /**
     * @var array
     */
    protected $nodes;

    /**
     * @var boolean
     */
    public $enableRetries = false;

    /**
     * @var int
     */
    protected $maxRetries = 1;

    /**
     * @var int
     */
    protected $retriesCount = 0;

    /**
     * Undocumented function
     *
     * @param array{
     *  httpClient: null,
     *  baseUrl:'',
     *  userAgent:'',
     *  clientSecret:'',
     *  clientId:'',
     *  fsId:''
     * }
     */
    public function __construct($config = [])
    {
        $config = array_merge(
            [
                'httpClient' => null,
                'baseUrl' => self::DEFAULT_BASE_URL,
                'userAgent' => self::DEFAULT_USER_AGENT,
                'clientSecret' => getenv(self::ENV_SECRET_NAME),
                'clientId' => (int) getenv(self::ENV_CLIENT_ID_NAME),
                'fsId' => getenv(self::ENV_FS_ID_NAME),
                'enableRetries' => false,
                'maxRetries' => self::MAX_RETRIES
            ],
            $config
        );
        // $shopId, $fsId, $clientId, $clientSecret)

        $this->setBaseUrl($config['baseUrl']);
        $this->setUserAgent($config['userAgent']);
        $this->clientSecret = $config['clientSecret'];
        $this->clientId = $config['clientId'];
        $this->fsId = $config['fsId'];
        $this->enableRetries = $config['enableRetries'];

        if (!$config['httpClient']) {
            $reauthClient = new HttpClient(
                [
                    // URL for access_token request
                    'base_uri' => 'https://accounts.tokopedia.com/token?grant_type=client_credentials',
                ]
            );

            $reauthConfig = [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ];

            $grantType = new ClientCredentials($reauthClient, $reauthConfig);
            $refreshGrantType = new RefreshToken($reauthClient, $reauthConfig);
            $oauth = new OAuth2Middleware($grantType, $refreshGrantType);

            if (isset($config['cacheProvider'])) {
                $oauth->setTokenPersistence($config['cacheProvider']);
            }

            $stack = HandlerStack::create();
            $stack->push($oauth);

            // This is the normal Guzzle client that you use in your application
            $this->setHttpClient(
                new HttpClient(
                    [
                        'handler' => $stack,
                        'auth' => 'oauth',
                        'base_uri' => $this->baseUrl
                    ]
                )
            );
        } else {
            $this->setHttpClient($config['httpClient'] ?: new HttpClient());
        }
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param  \GuzzleHttp\ClientInterface $client
     * @return $this
     */
    public function setHttpClient($client)
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param  string $userAgent
     * @return $this
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return \Psr\Http\Message\UriInterface
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setBaseUrl($url)
    {
        $this->baseUrl = new Uri($url);

        return $this;
    }

    /**
     * @return string|int The fsId
     */
    public function getFsId()
    {
        return $this->fsId;
    }

    protected function defaultHeaders()
    {
        return ['User-Agent' => $this->userAgent];
    }

    /**
     * It takes a method, uri, query and data and returns a request object
     *
     * @param string method The HTTP method to use for the request.
     * @param uri The URI to send the request to.
     * @param array query The query parameters to be added to the request.
     * @param data The data to be sent to the API.
     *
     * @return \Psr\Http\Message\RequestInterface A Request object
     */
    public function request($method, $uri, $query = [], $data = null, $headers = [])
    {
        if (is_string($uri)) {
            $uri = str_replace(':fs_id', $this->getFsId(), $uri);
        }
        $uri = Utils::uriFor($uri);
        $path = $this->baseUrl->getPath() . $uri->getPath();

        if (substr($path, 0, 1) !== '/') {
            $path = '/' . $path;
        }

        $uri = $uri->withPath($path);

        $queryFromUri = [];
        parse_str($uri->getQuery(), $queryFromUri);

        $query = array_merge($query, $queryFromUri);

        $uri = $uri
            ->withQuery(http_build_query($query))
            ->withScheme($this->baseUrl->getScheme())
            ->withUserInfo($this->baseUrl->getUserInfo())
            ->withHost($this->baseUrl->getHost())
            ->withPort($this->baseUrl->getPort());

        $applyHeaders = array_merge(
            $this->defaultHeaders(),
            $headers
        );

        $this->currentRequest = new Request(
            $method,
            $uri,
            $applyHeaders,
            $data instanceof MultipartStream ?
            $data : (is_null($data) ?
                null :
                json_encode($data)
            )
        );


        return $this->currentRequest;
    }

    /**
     * It sends a request to the server and returns a response
     *
     * @param \Psr\Http\Message\RequestInterface request The request object to send.
     *
     * @return \Psr\Http\Message\ResponseInterface A response object.
     */
    public function send($request)
    {
        try {
            $response = $this->httpClient->send($request);
            return $response;
        } catch (\Exception $exception) {
            return $this->throwExceptionOrRetry($exception);
        }
    }

    /**
     * If the exception is a GuzzleClientException, throw a custom exception based on the status
     * code. If the exception is a GuzzleServerException, throw a custom server exception. Otherwise,
     * throw a generic exception
     *
     * @param exception The exception that was thrown.
     */
    public function throwExceptionOrRetry($exception)
    {
        if ($exception instanceof ExceptionClientException) {

            switch ($exception->getCode()) {
                case 429:
                    if ($this->enableRetries && $this->retriesCount < $this->maxRetries) {
                        $this->retriesCount++;
                        $wait = (int) $exception->getResponse()->getHeader('X-Ratelimit-Full-Reset-After')[0];
                        sleep($wait);
                        return $this->retry();
                    }
                    $className = TooManyRequestException::class;
                    break;
                case 400:
                    $className = BadRequestException::class;
                    break;
                case 403:
                    $className = AuthException::class;
                    break;
                default:
                    $className = ClientException::class;
            }

            throw Factory::create($className, $exception);
        }

        if ($exception instanceof ExceptionServerException) {
            throw Factory::create(ServerException::class, $exception);
        }

        throw new \Exception($exception);
    }

    /**
     * This function is used to retry the current request
     *
     * @return The return value is the response from the server.
     */
    public function retry()
    {
        return $this->send($this->currentRequest);
    }
}
