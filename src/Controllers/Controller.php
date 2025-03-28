<?php

namespace SPPAY\SPPAYLaravel\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;

abstract class Controller
{
    public function __construct(protected Client $client, protected ?string $accessToken = null)
    {
        $url = config('sppay.base_url') . '/oauth/token';

        $this->accessToken = Cache::remember('sppay_access_token', 1800, function () use ($url) {
            $response = $this->client->request('POST', $url, [
                'json' => [
                    "grant_type" => config('sppay.grant_type'),
                    "client_id" => config('sppay.client_id'),
                    "client_secret" => config('sppay.client_secret'),
                    "username" => config('sppay.username'),
                    "password" => config('sppay.password'),
                ]
            ]);

            $response = json_decode($response->getBody()->getContents());
            return $response->access_token;
        });
    }

    public function fetchData($endpoint): ResponseInterface
    {
        $url = config('sppay.base_url') . $endpoint;
        return $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$this->accessToken,
            ]
        ]);
    }

    public function sendRequest($endpoint, $body): ResponseInterface
    {
        $url = config('sppay.base_url') . $endpoint;
        return $this->client->request('POST', $url, [
            'json' => $body,
            'headers' => [
                'Authorization' => 'Bearer '.$this->accessToken,
            ]
        ]);
    }
}
