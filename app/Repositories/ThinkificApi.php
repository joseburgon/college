<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class ThinkificApi
{
    private $baseUrl = 'https://api.thinkific.com/api/public/v1/';

    private $headers = [
        'X-Auth-API-Key' => '036142af339bb57d675eedf9b7953c97',
        'X-Auth-Subdomain' => 'livingroomcollege',
        'Content-Type' => 'application/json',
    ];

    public function __construct()
    {
        //
    }

    public function createUser($data)
    {
        $response = Http::withHeaders($this->headers)
                            ->post($this->baseUrl . 'users', $data);

        return $response;
    }
}
