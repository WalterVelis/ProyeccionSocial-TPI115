<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB:: table('users')->insert(array(
            'name' =>'Felipe Argueta',
            'email'=>'administrador@gmail.com',
            'password'=>\Hash::make('admin01'),
            'type'=>'admin',
            'avatar' =>'user_default.png',
            'active' =>'1',
            'code' =>'',
        	));
    }
}
