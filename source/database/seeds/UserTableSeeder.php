<?php
namespace App\Seed;

use DB;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
                DB::table('users')->insert([
                    'name' => 'admin',
                    'lastname' => 'root',
                    'email' => 'admin@admin.com',
                    'password' => bcrypt('123456'),
                    'lastupdate' => date('Y-m-d H:i:s'),
                    'datecreate' => date('Y-m-d H:i:s'),
                ]);
                DB::table('users')->insert([
                    'name' => 'client',
                    'lastname' => 'user',
                    'email' => 'client@client.com',
                    'password' => bcrypt('123456'),
                    'lastupdate' => date('Y-m-d H:i:s'),
                    'datecreate' => date('Y-m-d H:i:s'),
                ]);
	}

}
