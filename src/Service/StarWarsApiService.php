<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class StarWarsApiService
{

    public function __construct(
        private readonly HttpClientInterface $httpClient
    ) {
    }

    private const BASE_URL = 'https://swapi.dev/api/people/';
    private const ITEM = 'ITEM';
    private const COLLECTION = 'COLLECTION';

    public function getPersonnages(): array
    {
        return $this->makeRequest(self::COLLECTION);
    }

    public function getPersonnage($id): array
    {
        return $this->makeRequest(self::ITEM, $id);
    }


    private function makeRequest(string $type, ?int $id = null): array
    {
        $url = $id ? self::BASE_URL . $id : self::BASE_URL;

        $response = $this->httpClient->request('GET', $url);

        $data = match ($type) {
            self::COLLECTION => $response->toArray()['results'],
            self::ITEM => $response->toArray(),
        };

        return $data;
    }
}
