<?php

namespace App\Console\Commands;

use App\ExternalApis\ThinkificApi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ActivateEnrollments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enrollments:activate {course} {duration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $createdAfter = Carbon::createFromDate(2020, 11, 14);

        $queryParams = [
            'query[course_id]' => $this->argument('course'),
            'query[created_after]' => $createdAfter->toJSON(),
            'query[expired]' => true,
            'limit' => '100',
        ];

        $enrollments = ThinkificApi::getCourseEnrollments($queryParams);

        $bar = $this->output->createProgressBar(count($enrollments));

        $bar->start();

        $activatedAtDate = Carbon::now();
        $expiryDate = $activatedAtDate->addDays($this->argument('duration'));

        foreach ($enrollments as $index => $enrollment) {

            $data = [
                'activated_at' => $activatedAtDate->toJSON(),
                'expiry_date' => $expiryDate->toJSON(),
            ];

            try {

                ThinkificApi::updateEnrollment($enrollment['id'], $data);

            } catch (\Throwable $e) {

                Log::error('Something went wrong when updating enrollment: ' . $enrollment['id']);

                report($e);

            }

            $bar->advance();

            if ($this->pauseIsNeeded($index + 1)) {

                sleep(30);

            }

        }

        $bar->finish();

    }

    private function pauseIsNeeded($index): bool
    {

        return ($index % 100 === 0 && $index > 0);

    }
}
