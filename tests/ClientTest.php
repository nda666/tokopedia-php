<?php

namespace TokopediaPhp\Tests;

use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use InvalidArgumentException;
use Psr\Http\Message\UriInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use TokopediaPhp\Exception\Api\ApiException;
use TokopediaPhp\Exception\Api\BadRequestException;
use TokopediaPhp\Exception\Api\ClientException;
use TokopediaPhp\Exception\Api\ServerException;
use TokopediaPhp\SignatureGenerator;
use TokopediaPhp\SignatureGeneratorInterface;
use stdClass;
use TokopediaPhp\Nodes\Finance;
use TokopediaPhp\Nodes\Interaction;
use TokopediaPhp\Nodes\Logistic;
use TokopediaPhp\Nodes\Order;
use TokopediaPhp\Nodes\Product;
use TokopediaPhp\Nodes\Shop;
use TokopediaPhp\Client;
use TokopediaPhp\Exception\Api\AuthException;
use TokopediaPhp\Exception\Api\TooManyRequestException;

use function PHPUnit\Framework\isInstanceOf;

/**
 * Undocumented class
 *
 * @category description
 * @package  category
 * @author   Name <adhabakhtiar@gmail.com>
 * @license  MIT
 * @link     http://url.com
 */
class ClientTest extends TestCase
{
    use ClientTrait;
    public function testCreateClient()
    {
        $tokopedia = $this->createClient([
            'fsId' => 'RANDOM_FS_ID',
        ]);

        $this->assertInstanceOf(Client::class, $tokopedia);
        $this->assertInstanceOf(ClientInterface::class, $tokopedia->getHttpClient());
        $this->assertInstanceOf(UriInterface::class, $tokopedia->getBaseUrl());
        $this->assertEquals(Client::DEFAULT_BASE_URL, $tokopedia->getBaseUrl()->__toString());
        $this->assertEquals(Client::DEFAULT_USER_AGENT, $tokopedia->getUserAgent());
        $this->assertEquals('RANDOM_FS_ID', $tokopedia->getFsId());
    }

    public function testShouldBeOkWhenNewRequest()
    {
        $uri = Utils::uriFor(Client::DEFAULT_BASE_URL . '/v1/products/fs/15901/active?shop_id=1200');
        $expected = new Request(
            'POST',
            $uri,
            [
                'User-Agent' => Client::DEFAULT_USER_AGENT,
            ],
            '{"product_id":[100000,200000]}'
        );

        $actual = $this->createClient([
            'fsId' => '15901',
        ])->request(
            'POST',
            '/v1/products/fs/:fs_id/active',
            [
                'shop_id' => "1200",
            ],
            [
                'product_id' => [
                    100000,
                    200000
                ],
            ]
        );

        $this->assertEquals($expected->getMethod(), $actual->getMethod());
        $this->assertEquals($expected->getUri(), $actual->getUri());
        $this->assertEquals($expected->getHeaders(), $actual->getHeaders());
        $this->assertEquals($expected->getBody()->getContents(), $actual->getBody()->getContents());
        $this->assertEquals($expected->getProtocolVersion(), $actual->getProtocolVersion());
    }

    public function getRequestUriCases()
    {
        return [
            [
                'https://fs.tokopedia.net',
                'inventory/v1/fs/13004/product/info',
                'https://fs.tokopedia.net/inventory/v1/fs/13004/product/info',
            ],
            [
                'https://fs.tokopedia.net',
                '/v2/order/list',
                'https://fs.tokopedia.net/v2/order/list',
            ],
        ];
    }

    /**
     * @dataProvider getRequestUriCases
     * @param string $baseUri
     * @param string $actualUri
     * @param string $exceptedUri
     * @throws \Exception
     */
    public function testShouldBeOkWhenNewRequestWithUri(string $baseUri, string $actualUri, string $exceptedUri)
    {
        $client = $this->createClient([
            'baseUrl' => $baseUri,
        ]);

        $expected = Utils::uriFor($exceptedUri);
        $actual = $client->request("GET", $actualUri)->getUri();

        $this->assertEquals($expected, $actual);
    }

    public function testShouldBeOkWhenSend()
    {
        $expected = new Response(200, [], '"pong"');
        $client = $this->createClient([], $this->createHttpClient($expected));

        $request = $client->request('GET', 'ping');
        $actual = $client->send($request);

        $this->assertEquals($expected, $actual);
    }

    public function getApiExceptionCases()
    {
        return [
            [
                400,
                BadRequestException::class,
            ],
            [
                403,
                ClientException::class,
            ],
            [
                405,
                ClientException::class,
            ],
            [
                429,
                TooManyRequestException::class,
            ],
            [
                500,
                ServerException::class,
            ],
            [
                503,
                ServerException::class,
            ],
        ];
    }

    /**
     * @dataProvider getApiExceptionCases
     * @param int $statusCode
     * @param string $expected
     * @throws \Exception
     * @group test
     */
    public function testThrowExceptionWhenSendIsError(int $statusCode, string $expected)
    {
        try {
            $expectedData = [
                "header" => [
                    "process_time" => 0.001552878,
                    "messages" => "Your request format or parameters have some problem.",
                    "reason" => "invalid shop_id format",
                    "error_code" => 0
                ],
                "data" => null
            ];
            $response = new Response($statusCode, ['Content-Type' => 'application/json'], json_encode($expectedData));

            $client = $this->createClient();
            $client->setHttpClient($this->createHttpClient($response));

            $request = $client->request('GET', 'ping');
            $client->send($request);
        } catch (ApiException $actual) {
            $this->assertInstanceOf($expected, $actual);
            $this->assertEquals($statusCode, $actual->getCode());
            $this->assertEquals(json_decode(json_encode($expectedData)), $actual->getData());
            $this->assertInstanceOf(Request::class, $actual->getRequest());
            $this->assertInstanceOf(Response::class, $actual->getResponse());
            $this->assertEquals([], $actual->getContext());
        }
    }

    /**
     * @param int $statusCode
     * @param string $expected
     * @throws \Exception
     */
    public function testSendWithNonResponseParam()
    {
        try {
            $response = new Exception('RANDOM ERROR');
            $client = $this->createClient([]);
            $client->setHttpClient($this->createHttpClient($response));
            $request = $client->request('GET', 'ping');
            $client->send($request);
        } catch (Exception $actual) {
            $this->assertInstanceOf(Exception::class, $actual);
        }
    }

    /**
     * @param int $statusCode
     * @param string $expected
     * @throws \Exception
     */
    public function testThrow429ShouldSleepAndRetry()
    {
        $mock = $this->getMockBuilder(Client::class)
            ->setMethods(['retry'])
            ->setConstructorArgs([['enableRetries' => true]])
            ->getMock();
        $mock->expects($this->once())->method('retry')->willReturn(true);

        $response = new Response(429, ['X-Ratelimit-Full-Reset-After' => 1]);

        $client = $this->createClient([], null, $mock);


        $client->setHttpClient($this->createHttpClient($response));

        $request = $client->request('GET', 'ping');
        $client->send($request);
    }

    public function testShouldBeOkWhenSendWithRetry()
    {
        $mock = $this->getMockBuilder(Client::class)->setMethods(['send'])->getMock();
        $mock->expects($this->once())->method('send')
            ->with($this->isInstanceOf(RequestInterface::class))
            ->willReturn(true);

        $response = new Response(429, ['X-Ratelimit-Full-Reset-After' => 1]);

        $client = $this->createClient([], null, $mock);
        $client->setHttpClient($this->createHttpClient($response));

        $request = $client->request('GET', 'ping');

        $client->retry();
    }
}
