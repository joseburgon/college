<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ThinkificApi
{
    private $baseUrl = 'https://api.thinkific.com/api/public/v1/';

    private $headers = null;

    public function __construct()
    {
        $this->headers = [
            'X-Auth-API-Key' => config('app.thinkific_api_key'),
            'X-Auth-Subdomain' => 'livingroomcollege',
            'Content-Type' => 'application/json',
        ];
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

    public function getStudentEnrollments($email)
    {
        $response = Http::withHeaders($this->headers)
            ->get($this->baseUrl . 'enrollments', [
                'query[email]' => $email,
                'page' => '1',
                'limit' => '25'
            ]);

        if ($response->successful()) {

            Log::info('Getting student enrollments', $response->json());

            return $response->json()['items'];

        } else {

            Log::error('Error getting student enrollments', $response->json());

            return [];

        }
    }

    public function getEnrolledStudents($course, $page)
    {
        $response = Http::withHeaders($this->headers)
            ->get($this->baseUrl . 'enrollments', [
                'query[course_id]' => $course,
                'page' => $page,
                'limit' => '50'
            ])
            ->throw()
            ->json();

        Log::info('Getting course enrolled students', $response);

        return $response;
    }

    public function getCourseEnrollments($course)
    {
        $courseEnrollments = [];
        $page = 1;
        $totalPages = 0;

        do {
            $response = Http::withHeaders($this->headers)
                ->get($this->baseUrl . 'enrollments', [
                    'query[course_id]' => $course,
                    'query[expired]' => false,
                    'page' => $page,
                    'limit' => '50'
                ]);

            if ($response->successful()) {

                $courseEnrollments = array_merge($courseEnrollments, $response['items']);

                $totalPages++;

                $page++;

            }
        } while ($response['meta']['pagination']['total_pages'] > $totalPages);

        return $courseEnrollments;

    }

    public function updateEnrollment($id, $data)
    {
        $response = Http::withHeaders($this->headers)
            ->put($this->baseUrl . 'enrollments/' . $id, $data);

        if ($response->successful()) {

            Log::info('Updating enrollment ' . $id);

            return $response->json();

        } else {

            Log::error('Error updating enrollment ' . $id, $response->json());

            return [];

        }
    }
}
