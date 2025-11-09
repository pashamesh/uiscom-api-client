<?php

declare(strict_types=1);

namespace Uiscom;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use InvalidArgumentException;

/**
 * @method object loginUser(array<string,mixed> $params = [])
 * @method object logoutUser(array<string,mixed> $params = [])
 *
 * @method object startEmployeeCall(array<string,mixed> $params = [])
 * @method object startScenarioCall(array<string,mixed> $params = [])
 * @method object startVnumberCall(array<string,mixed> $params = [])
 * @method object startInformerCall(array<string,mixed> $params = [])
 * @method object startSimpleCall(array<string,mixed> $params = [])
 *
 * @method object makeCall(array<string,mixed> $params = [])
 * @method object transferTalk(array<string,mixed> $params = [])
 * @method object restoreTalk(array<string,mixed> $params = [])
 * @method object holdCall(array<string,mixed> $params = [])
 * @method object unholdCall(array<string,mixed> $params = [])
 * @method object tagCall(array<string,mixed> $params = [])
 * @method object disconnectLeg(array<string,mixed> $params = [])
 * @method object addCoach(array<string,mixed> $params = [])
 * @method object recordCall(array<string,mixed> $params = [])
 * @method object blockContact(array<string,mixed> $params = [])
 * @method object callTalkOption(array<string,mixed> $params = [])
 * @method object sendDtmf(array<string,mixed> $params = [])
 * @method array<int, object> listTalkOptions(array<string,mixed> $params = [])
 * @method array<int, object> listCalls(array<string,mixed> $params = [])
 * @method object releaseCall(array<string,mixed> $params = [])
 */
class CallApiClient
{
    private string $version = 'v4.0';
    private ?string $accessToken = null;
    private ?int $accessTokenExpires = null;
    private ?string $login = null;
    private ?string $password = null;
    private Client $client;

    private ?object $metadata = null;
    private string $baseUri;

    public function __construct(CallApiConfig $config, ?Client $client = null)
    {
        $this->client = $client ?? new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json; charset=UTF-8',
            ],
        ]);

        $this->accessToken = $config->getAccessToken();
        $this->login = $config->getLogin();
        $this->password = $config->getPassword();
        $this->baseUri = rtrim($config->getEntryPoint(), '/') .
            '/' . $this->version;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    private function refreshAccessToken(): void
    {
        // Check if access token is not expired
        if (
            $this->accessToken && (is_null($this->accessTokenExpires)
                || $this->accessTokenExpires > (time() + 60))
        ) {
            return;
        }

        /**
         * @var object{
         *     access_token: string,
         *     expire_at: integer,
         * } $response
         */
        $response = $this->doRequest(
            'login.user',
            [
                'login' => $this->login,
                'password' => $this->password,
            ]
        );

        $this->accessToken = $response->access_token;
        $this->accessTokenExpires = $response->expire_at;
    }

    /**
     * Get last response metadata
     *
     */
    public function metadata(): ?object
    {
        return $this->metadata;
    }

    /**
     * @param array<int,array<string,mixed>> $arguments
     *
     * @return array<int,object>|object
     *
     */
    public function __call(string $camelCaseMethod, array $arguments)
    {
        $this->refreshAccessToken();

        $camelCaseMethod = preg_replace(
            '~(.)(?=[A-Z])~',
            '$1_',
            $camelCaseMethod
        );

        if (!is_string($camelCaseMethod)) {
            throw new InvalidArgumentException('$camelCaseMethod must be a string');
        }

        $method = strtolower((string) preg_replace('~_~', '.', $camelCaseMethod, 1));

        $params = ['access_token' => $this->accessToken];
        if (isset($arguments[0])) {
            $params = array_merge($params, $arguments[0]);
        }

        return $this->doRequest($method, $params);
    }

    /**
     * @param array<string,mixed> $params
     *
     * @return array<int,object>|object
     *
     * @throws Exception
     *
     */
    private function doRequest(string $method, array $params)
    {
        $payload = [
            'jsonrpc' => '2.0',
            'id' => time(),
            'method' => $method,
            'params' => $params,
        ];

        try {
            $response = $this->client->post($this->baseUri, ['json' => $payload]);

            /**
             * @var object{
             *     result: object{
             *         data: array<int,object>|object,
             *         metadata: object,
             *     },
             *     error: object{
             *         code: int,
             *         message: string,
             *     }
             * } $responseBody
             */
            $responseBody = json_decode($response->getBody()->getContents());

            if (isset($responseBody->result)) {
                $this->metadata = $responseBody->result->metadata ?? null;
            }

            if (isset($responseBody->error)) {
                throw new Exception(
                    $responseBody->error->message,
                    $responseBody->error->code
                );
            }

            return $responseBody->result->data;
        } catch (TransferException $transferException) {
            throw new Exception(
                $transferException->getMessage(),
                $transferException->getCode(),
                $transferException
            );
        }
    }
}
