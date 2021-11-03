<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class AddNewBucaramangaLeaders extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/csvs/new_bga_leaders.csv';
        $this->tablename = 'leaders';
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
