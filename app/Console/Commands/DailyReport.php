<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily_report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '日报统计';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->doHandle();
    }

    protected function doHandle() {
        // 统计10天内的
        $start = Carbon::now()->subDays(10);
        while ($start < Carbon::now()) {
            $day_start = $start->clone()->startOfDay();
            $day_end = $start->clone()->endOfDay();
            $date = $start->clone()->format("Y-m-d");
            $sell_amount = Order::query()
                ->where("status", Order::ORDER_PAID)
                ->whereBetween("create_time", [$day_start, $day_end])
                ->sum("actual_price");
            $chip_total = 0;
            $withdrawal_amount = 0;
            $promo_amount = 0;
            if(!$daily_report = \App\Models\DailyReport::query()->where("date", $date)->first()) {
                $daily_report = new \App\Models\DailyReport();
                $daily_report->date = $date;
            }
            $daily_report->sell_amount = $sell_amount;
            $daily_report->chip_total = $chip_total;
            $daily_report->promo_amount = $promo_amount;
            $daily_report->withdrawal_amount = $withdrawal_amount;
            $daily_report->save();

            $start = $start->addDay();
        }
    }
}
