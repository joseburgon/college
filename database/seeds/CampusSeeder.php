<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class CampusSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/csvs/campuses.csv';
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
