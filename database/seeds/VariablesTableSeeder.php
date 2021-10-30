<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variables')->insert([
            'mins_available_after_closing' => 15,
            'tolerance_mins' => 15,
            'percentage' => 2000,
            'chargeback_1' => 1000,
            'chargeback_2' => 2000,
            'chargeback_3' => 3000,
            'chargeback_4' => 5000,
        ]);
    }
}
