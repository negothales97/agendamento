<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'title' => 'Ajuda e suporte',
                'content' => 'Lorem ipsum'
            ],
            [
                'title' => 'Termos e condições',
                'content' => 'Lorem ipsum'
            ],
            [
                'title' => 'Sobre este App',
                'content' => 'Lorem ipsum'
            ],
            [
                'title' => 'Política de privacidade',
                'content' => 'Lorem ipsum'
            ]
        ]);
    }
}
