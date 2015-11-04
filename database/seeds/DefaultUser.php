<?php

use Illuminate\Database\Seeder;

class DefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('roles')->delete();
	    DB::table('users')->insert(
			array(
                array (
                    'role_id' => '1',
                    'name' => 'admin',
                    'email' => 'temporary@temp.dev',
                    'password' => Hash::make('admin'),
                    'confirmation_code' => md5(uniqid(mt_rand(),true)),
                    'confirmed' => '1',
                    'blocked' => false,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
				),
			));
	    DB::table('profiles')->insert(
	    	array(
	            array (
                    'user_id' => '1',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
				),
			)
	    );

    }
}
