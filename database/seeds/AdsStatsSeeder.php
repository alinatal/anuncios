<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdsStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ads_stats')->insert([
            ['ads' => 0, 'from'=> date_create('01-01-'.date('Y')), 'to' => date_create('31-01-'.date('Y'))],
            ['ads' => 0, 'from'=> date_create('01-02-'.date('Y')), 'to' => date_create('28-02-'.date('Y'))],
            ['ads' => 0, 'from'=> date_create('01-03-'.date('Y')), 'to' => date_create('31-03-'.date('Y'))],
            ['ads' => 0, 'from'=> date_create('01-04-'.date('Y')), 'to' => date_create('30-04-'.date('Y'))],
            ['ads' => 0, 'from'=> date_create('01-05-'.date('Y')), 'to' => date_create('31-05-'.date('Y'))],
            ['ads' => 0, 'from'=> date_create('01-06-'.date('Y')), 'to' => date_create('30-06-'.date('Y'))],
            ['ads' => 0, 'from'=> date_create('01-07-'.date('Y')), 'to' => date_create('31-07-'.date('Y'))],
            /*['ads' => rand(1,100), 'from'=> date_create('01-01-'.date('Y')), 'to' => date_create('31-01-'.date('Y'))],
            ['ads' => rand(1,100), 'from'=> date_create('01-02-'.date('Y')), 'to' => date_create('28-02-'.date('Y'))],
            ['ads' => rand(1,100), 'from'=> date_create('01-03-'.date('Y')), 'to' => date_create('31-03-'.date('Y'))],
            ['ads' => rand(1,100), 'from'=> date_create('01-04-'.date('Y')), 'to' => date_create('30-04-'.date('Y'))],
            ['ads' => rand(1,100), 'from'=> date_create('01-05-'.date('Y')), 'to' => date_create('31-05-'.date('Y'))],
            ['ads' => rand(1,100), 'from'=> date_create('01-06-'.date('Y')), 'to' => date_create('30-06-'.date('Y'))],
            ['ads' => rand(1,100), 'from'=> date_create('01-07-'.date('Y')), 'to' => date_create('31-07-'.date('Y'))],
            ['ads' => rand(1,100), 'from'=> date_create('01-08-'.date('Y')), 'to' => date_create('31-08-'.date('Y'))],
            ['ads' => rand(1,100), 'from'=> date_create('01-09-'.date('Y')), 'to' => date_create('30-09-'.date('Y'))],
            ['ads' => rand(1,100), 'from'=> date_create('01-10-'.date('Y')), 'to' => date_create('31-10-'.date('Y'))],
            ['ads' => rand(1,100), 'from'=> date_create('01-11-'.date('Y')), 'to' => date_create('30-11-'.date('Y'))],
            ['ads' => rand(1,100), 'from'=> date_create('01-12-'.date('Y')), 'to' => date_create('31-12-'.date('Y'))]*/
        ]);
    }
}
