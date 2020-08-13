<?php
namespace App\Console\Closures;

use Illuminate\Support\Facades\DB;

class AdStats{
    public function __invoke()
    {
        $from = now()->subMonth()->firstOfMonth();
        $to = now()->subMonth()->lastOfMonth()->endOfDay();

        $number_of_ads = DB::table('ads')
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->count();

        DB::table('ads_stats')->insert(['ads'=> $number_of_ads, 'from'=> $from, 'to' => $to]);
    }
}
