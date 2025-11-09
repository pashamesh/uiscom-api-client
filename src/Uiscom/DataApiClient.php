<?php

namespace Uiscom;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use InvalidArgumentException;

/**
 * @method array<int, array<string, mixed>> getCallsReport(array<string, mixed> $params = [])
 */
class DataApiClient
{
    private string $version = 'v2.0';
    private DataApiConfig $config;
    private Client $client;

    private ?object $metadata = null;

    public function __construct(DataApiConfig $config, ?Client $client = null)
    {
        $this->client = $client ?? new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json; charset=UTF-8',
            ],
        ]);
        $this->config = $config;
    }

    private function getBaseUri(): string
    {
        return rtrim($this->config->getEntryPoint(), '/') .
            '/' . $this->version;
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
        $camelCaseMethod = preg_replace(
            '~(.)(?=[A-Z])~',
            '$1_',
            $camelCaseMethod
        );

        if (! is_string($camelCaseMethod)) {
            throw new InvalidArgumentException('$camelCaseMethod must be a string');
        }

        $method = strtolower((string) preg_replace('~_~', '.', $camelCaseMethod, 1));

        $params = ['access_token' => $this->config->getAccessToken()];
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
     * @throws \Exception
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
            $response = $this->client->post($this->getBaseUri(), ['json' => $payload]);

            /**
             * @var object{
             *     result: object{
             *         data: array<int,object>|object,
             *         metadata: object,
             *     },
             *     error: object{
             *         code: string,
             *         message: string,
             *     }
             * } $responseBody
             */
            $responseBody = json_decode($response->getBody()->getContents());

            if (isset($responseBody->result)) {
                $this->metadata = $responseBody->result->metadata;
            }

            if (isset($responseBody->error)) {
                throw new \Exception(
                    "{$responseBody->error->code} {$responseBody->error->message}"
                );
            }

            return $responseBody->result->data;
        } catch (TransferException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
