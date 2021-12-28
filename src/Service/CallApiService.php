<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;


    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    public function getFranceData(): array
    {
        return $this->getApi('france');
    }

    public function getAllDepartmentsData(): array
    {
        return $this->getApi('departements');
    }

    public function getDepartementData(string $departement): array
    {
        return $this->getApi("departement/$departement");
    }

    private function getApi(string $var): array
    {
        $response = $this->client->request(
            'GET',
            'https://coronavirusapifr.herokuapp.com/data/live/' . $var
        );
        return $response->toArray();
    }

}