<?php

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
        	[
	            'name' => 'Lucas Borelli',
				'email' => 'lucas@imaxinformatica.com.br',
				'role_id' => 1,
				'password' => '$2y$10$H36Ix1NMNg0LLR3ZXJgy2OvMO3q8AK7JEPVYOjz5w7giHp2fNGyFu'
            ],
            [
	            'name' => 'Thales Serra',
				'email' => 'thales@imaxinformatica.com.br',
				'role_id' => 1,
				'password' => '$2y$10$H36Ix1NMNg0LLR3ZXJgy2OvMO3q8AK7JEPVYOjz5w7giHp2fNGyFu'
	        ],
			[
	            'name' => 'Dainel',
				'email' => 'daniel@avivare.com.br',
				'role_id' => 1,
				'password' => bcrypt('wXImkJx4!Yln')
	        ],
			[
	            'name' => 'Beto',
				'email' => 'beto@avivare.com.br',
				'role_id' => 1,
				'password' => bcrypt('zW$VUAnHa#Ni')
	        ],
			[
	            'name' => 'Honorato',
				'email' => 'honorato@avivare.com.br',
				'role_id' => 1,
				'password' => bcrypt('7^PFhRpB6xk!')
	        ],
    	]);
    }
}