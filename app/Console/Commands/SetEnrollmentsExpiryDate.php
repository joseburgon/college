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
        try {
            $query = [
                'query[course_id]' => $this->argument('course')
            ];

            $enrollments = ThinkificApi::getCourseEnrollments($query);

            $bar = $this->output->createProgressBar(count($enrollments));

            $bar->start();

            foreach ($enrollments as $enrollment) {
                Log::info('Enrollment ID: ' . $enrollment['id']);

                $expiryDate = Carbon::now()->addDays(32);

                Log::info('Calculated expiry date: ' . $expiryDate);

                $data = [
                    'activated_at' => $enrollment['activated_at'],
                    'expiry_date' => $expiryDate->toISOString()
                ];

                ThinkificApi::updateEnrollment($enrollment['id'], $data);

                $bar->advance();

                Log::info('Enrollment updated!');
            }

            $bar->finish();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
