<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ThinkificApi
{
    private $baseUrl = 'https://api.thinkific.com/api/public/v1/';

    private $headers = [
        'X-Auth-API-Key' => '4809eb3ce19d7b86e1b7a216c7c17874',
        'X-Auth-Subdomain' => 'livingroomcollege',
        'Content-Type' => 'application/json',
    ];

    public function __construct()
    {
        //
    }

    public function getUsers()
    {

        $response = Http::withHeaders($this->headers)
            ->get($this->baseUrl . 'users')
            ->throw();

        if ($response->successful()) {

            return $response->json();
        }
    }

    public function getUser($email)
    {

        $response = Http::withHeaders($this->headers)
            ->get($this->baseUrl . 'users', [
                'query[email]' => $email
            ])
            ->throw()
            ->json();

        return $response['items']['0'];
    }

    public function checkIfUserExists($email)
    {
        $response = Http::withHeaders($this->headers)
            ->get($this->baseUrl . 'users', [
                'query[email]' => $email
            ])
            ->throw()
            ->json();

        Log::info('check if user exists response', $response);

        if (empty($response['items'])) {

            return false;

        } else {

            return true;
        }
    }

    public function createUser($data)
    {
        $response = Http::withHeaders($this->headers)
            ->post($this->baseUrl . 'users', $data);


        if ($response->successful()) {

            return $response->json();

        } else {

            Log::info('Error creating user', $response->json());

        }
    }

    public function createEnrollment($data)
    {
        $response = Http::withHeaders($this->headers)
            ->post($this->baseUrl . 'enrollments', $data)
            ->throw();

        if ($response->successful()) {

            return $response->json();
        }
    }
}
