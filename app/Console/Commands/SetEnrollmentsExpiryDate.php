<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\ExternalApis\ThinkificApi;
use Illuminate\Support\Facades\Log;

class SetEnrollmentsExpiryDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enrollments:expiry_date {course}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setting enrollments expiry date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $enrollments = ThinkificApi::getCourseEnrollments($this->argument('course'));

        foreach ($enrollments as $enrollment) {

            Log::info('Enrollment ID: ' . $enrollment['id']);

            $startedAtDate = Carbon::now();

            $expiryDate = $startedAtDate->addWeeks(10);

            Log::info('Calculated expiry date: ' . $expiryDate);

            $data = [
                'activated_at' => $startedAtDate->toISOString(),
                'expiry_date' => $expiryDate->toISOString()
            ];

            ThinkificApi::updateEnrollment($enrollment['id'], $data);

            Log::info('Enrollment updated!');

        }
    }
}
