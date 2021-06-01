<?php

namespace AlexeyMarchenko\CloudMailRu;

use GuzzleHttp\{Client, Cookie\CookieJar, Exception\GuzzleException};
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;


class HttpClient
{

    public $client;

    private $cookie;


    public function __construct()
    {
        $this->client = new Client();
        $this->cookie = new CookieJar();
    }


    public function requestGet(string $url, array $headers = [])
    {
        try {
            return $response = $this->client->request('GET', $url, [
                'cookies' => $this->cookie,
                'verify' => false,
                'headers' => $headers,
            ]);
        } catch (GuzzleException $e) {
            throw new CloudMailRuException($e->getMessage());
        }
    }


    public function requestPost(string $url, array $postParams, array $headers = [])
    {
        try {
            return $response = $this->client->request('POST', $url, [
                'form_params' => $postParams,
                'cookies' => $this->cookie,
                'verify' => false,
                'headers' => $headers,
            ]);
        } catch (GuzzleException $e) {
            throw new CloudMailRuException($e->getMessage());
        }
    }


    public function requestPut(string $url, $body, array $headers = [])
    {
        try {
            return $response = $this->client->request('PUT', $url, [
                'body' => $body,
                'cookies' => $this->cookie,
                'verify' => false,
                'headers' => $headers,
            ]);
        } catch (GuzzleException $e) {
            throw new CloudMailRuException($e->getMessage());
        }
    }


    public function requestDelete()
    {
        try {

        } catch (GuzzleException $e) {
            throw new CloudMailRuException($e->getMessage());
        }
    }


    public function checkResponse(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 200) {
            return $response->getBody()->getContents();
        } else {
            throw new CloudMailRuException('Bad response ' . $response->getStatusCode());
        }
    }

}