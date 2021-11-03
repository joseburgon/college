<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class NewBgaCampusLeaderSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/csvs/new_bga_campus_leader.csv';
        $this->tablename = 'campus_leader';
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
