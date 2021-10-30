<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'view_post',
                'label' => 'Visualizar Posts'
            ],
            [
                'name' => 'edit_post',
                'label' => 'Editar Posts'
            ],
            [
                'name' => 'delete_post',
                'label' => 'Deletar Post'
            ]
        ]);

        DB::table('permission_roles')->insert([
            [
                'role_id' => 1,
                'permission_id' => 1
            ],
            [
                'role_id' => 1,
                'permission_id' => 2
            ],
            [
                'role_id' => 1,
                'permission_id' => 3
            ],
        ]);
    }
}
