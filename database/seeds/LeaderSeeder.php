<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class LeaderSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/csvs/leaders.csv';
        $this->delimiter = ',';
        $this->truncate = false;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::disableQueryLog();

        parent::run();
    }
}
