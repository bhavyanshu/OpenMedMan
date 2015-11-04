<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
		DB::table('roles')->delete();
		DB::table('roles')->insert(
			array(
				array (
					'rolename' => 'admin',
					'roleinfo' => 'Administrative role with access to all site features',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
					),
				array (
					'rolename' => 'doctors',
					'roleinfo' => 'Doctors role is used to provide access to only doctors administrative area.',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
					),
				array (
					'rolename' => 'staff',
					'roleinfo' => 'Staff role is most restrictive access role. Only to be used by staff of the hospital.',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
					),
				array (
					'rolename' => 'patient',
					'roleinfo' => 'Patient role has access to various site features like viewing reports, details, booking appointment.',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
					)
				));
	}
}
