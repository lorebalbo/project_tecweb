<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([[
	        'name' 			=> 'Lorenzo',
	        'surname' 		=> 'Balboni',
	        'email' 		=> 'lorenzo.balboni@gmail.com',
	        'password' 		=> bcrypt('password'),
	        'color' 		=> '#E9967A',
	        'updated_at' 	=> date('Y-m-d h:i:s'),
			'created_at' 	=> date('Y-m-d h:i:s')		        
		], [
	        'name' 			=> 'Leonardo',
	        'surname' 		=> 'Vanni',
	        'email' 		=> 'leonardo.vanni@gmail.com',
	        'password' 		=> bcrypt('password'),
	        'color' 		=> '#FFD700',	        
	        'updated_at' 	=> date('Y-m-d h:i:s'),
			'created_at' 	=> date('Y-m-d h:i:s')		        
		], [
	        'name' 			=> 'Giorgia',
	        'surname' 		=> 'Tamisari',
	        'email' 		=> 'giorgia.tamisari@gmail.com',
	        'password' 		=> bcrypt('password'),
	        'color' 		=> '#2E8B57',	        
	        'updated_at' 	=> date('Y-m-d h:i:s'),
			'created_at' 	=> date('Y-m-d h:i:s')		        
		]]);
    }
}
