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
        DB::table('users')->insert([[
			'is_admin'		=> true,
	        'name' 			=> 'Lorenzo',
	        'surname' 		=> 'Balboni',
	        'email' 		=> 'lorenzo.balboni@gmail.com',
	        'password' 		=> bcrypt('password'),
	        'color' 		=> '#3498DB',
	        'updated_at' 	=> date('Y-m-d h:i:s'),
			'created_at' 	=> date('Y-m-d h:i:s')		        
		], [
	        'is_admin'		=> true,
			'name' 			=> 'Federica',
	        'surname' 		=> 'Baroni',
	        'email' 		=> 'federica.baroni@gmail.com',
	        'password' 		=> bcrypt('password'),
	        'color' 		=> '#F7464A',	        
	        'updated_at' 	=> date('Y-m-d h:i:s'),
			'created_at' 	=> date('Y-m-d h:i:s')		        
		], [
	        'is_admin'		=> false,
			'name' 			=> 'Giovanni',
	        'surname' 		=> 'Bica',
	        'email' 		=> 'giovanni.bica@gmail.com',
	        'password' 		=> bcrypt('password'),
	        'color' 		=> '#46BFBD',	        
	        'updated_at' 	=> date('Y-m-d h:i:s'),
			'created_at' 	=> date('Y-m-d h:i:s')		        
		]]);
    }
}
