<?php

use Illuminate\Database\Seeder;

class UpdateFullCoursesPrices extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Course::where('name', 'Restore - Curso Completo')->update([
            'price' => 700000,
            'price_usd' => 190,
            'discount_percentage' => 14.28
        ]);

        \App\Models\Course::where('name', 'Messengers - Curso Completo')->update([
            'price' => 700000,
            'price_usd' => 190,
            'discount_percentage' => 14.28,
        ]);
    }
}
