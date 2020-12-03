<?php

namespace App\ExternalApis;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ThinkificApi
{
    private const BASE_URL = 'https://api.thinkific.com/api/public/v1/';

    private static $headers;

    public static function __constructStatic()
    {
        static::$headers = [
            'X-Auth-API-Key' => config('app.thinkific_api_key'),
            'X-Auth-Subdomain' => 'livingroomcollege',
            'Content-Type' => 'application/json',
        ];
    }

    public static function getUsers()
    {
        $response = Http::withHeaders(self::$headers)
            ->get(self::BASE_URL . 'users')
            ->throw();

        return $response->json();
    }

    public static function getUser($email)
    {
        $response = Http::withHeaders(self::$headers)
            ->get(self::BASE_URL . 'users', [
                'query[email]' => $email
            ])
            ->throw()
            ->json();

        return $response['items']['0'];
    }

    public static function checkIfUserExists($email)
    {
        $response = Http::withHeaders(self::$headers)
            ->get(self::BASE_URL . 'users', [
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

    public static function createUser($data)
    {
        $response = Http::withHeaders(self::$headers)
            ->post(self::BASE_URL . 'users', $data);

        if ($response->successful()) {

            return $response->json();

        } else {

            Log::info('Error creating user', $response->json());

        }
    }

    public static function createEnrollment($data)
    {
        $response = Http::withHeaders(self::$headers)
            ->post(self::BASE_URL . 'enrollments', $data)
            ->throw();

        return $response->json();
    }

    public static function getStudentEnrollments($email)
    {
        $response = Http::withHeaders(self::$headers)
            ->get(self::BASE_URL . 'enrollments', [
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

    public static function getEnrolledStudents($course, $page)
    {
        $response = Http::withHeaders(self::$headers)
            ->get(self::BASE_URL . 'enrollments', [
                'query[course_id]' => $course,
                'query[expired]' => false,
                'page' => $page,
                'limit' => '50'
            ])
            ->throw()
            ->json();

        Log::info('Getting course enrolled students', $response);

        return $response;
    }

    public static function getCourseEnrollments($course)
    {
        $courseEnrollments = [];
        $page = 1;
        $totalPages = 0;

        do {
            $response = Http::withHeaders(self::$headers)
                ->get(self::BASE_URL . 'enrollments', [
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

    public static function updateEnrollment($id, $data)
    {
        $response = Http::withHeaders(self::$headers)
            ->put(self::BASE_URL . 'enrollments/' . $id, $data);

        if ($response->successful()) {

            Log::info('Updating enrollment ' . $id);

            return $response->json();

        } else {

            Log::error('Error updating enrollment ' . $id, $response->json());

            return [];

        }
    }
}

ThinkificApi::__constructStatic();
