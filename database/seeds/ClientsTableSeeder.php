<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([[
            'contact_name'      => 'Piero',
	        'contact_surname' 	=> 'Nodi',
	        'contact_email' 	=> 'piero.nodi@gmail.com',
	        'business_name' 	=> 'Enel',
	        'updated_at' 	    => date('Y-m-d h:i:s'),
			'created_at' 	    => date('Y-m-d h:i:s')		        	        
		]]);
    }
}
