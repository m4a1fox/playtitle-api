<?php

namespace Playtitle;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Common
{
    protected $apiKey;
    protected $baseUrl = 'http://playtitle.io/api/';
    protected $domain;

    /**
     * Common constructor.
     *
     * @param $apiKey
     * @param bool $domainName
     */
    public function __construct($apiKey, $domainName = false)
    {
        $this->apiKey = $apiKey;
        $this->domain = $this->setDomainName($domainName);
    }

    /**
     * Send request
     *
     * @param string $apiUrl
     * @param array $params
     * @return array
     */
    protected function sendRequest($apiUrl, $params = []): array
    {
        try {
            $response = (new Client($this->buildHeaderForRequest()))->request('GET', $this->baseUrl . $apiUrl . '?' . http_build_query(array_merge(['api_token' => $this->apiKey], $params)));

            return json_decode($response->getBody()->getContents(), TRUE);
        } catch (ClientException $e) {
            return array_merge(['status' => false], json_decode($e->getResponse()->getBody()->getContents(), TRUE));
        } catch (\Exception $e) {
            return [
                'status' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Set domain
     *
     * @param bool $domainName
     * @return string
     */
    private function setDomainName($domainName = false): string
    {
        return $domainName ? $domainName : $_SERVER['HTTP_HOST'];
    }

    /**
     * Set guzzle headers
     *
     * @return array
     */
    private function buildHeaderForRequest(): array
    {
        return ['headers' => ['referer' => $this->domain]];
    }
}