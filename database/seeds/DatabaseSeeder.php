<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        //Crear Usuario Administrador
        DB::table('users')->insert([
            'id' => '1',
            'usuario'=> 'admin',
            'password' => bcrypt('12345'),
            'Condicion' => '1',
            'ID_Rol'=>'1'
        ]);
    }
}
