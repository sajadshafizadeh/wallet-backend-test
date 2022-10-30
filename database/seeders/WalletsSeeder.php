<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class WalletsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 		DB::table('wallets')->insert([
            [	
            	'user_id' => 1,
            	'type' => 'deposit',
            	'amount' => 100000,
            	'tracking_code' => 123456789101112,
            	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [	
            	'user_id' => 1,
            	'type' => 'payment',
            	'amount' => -2000,
            	'tracking_code' => 123456789101113,
            	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
			[	
            	'user_id' => 1,
            	'type' => 'payment',
            	'amount' => -8000,
            	'tracking_code' => 123456789101114,
            	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
			[	
            	'user_id' => 1,
            	'type' => 'withdraw',
            	'amount' => -50000,
            	'tracking_code' => 123456789101115,
            	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

        ]);
    }
}
