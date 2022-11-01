<?php

namespace App\Console\Commands;

use App\Models\Activity;
use App\Models\Order;
use App\Models\OrdersChild;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ActivityReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity_report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '活动报表统计';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $this->doHandle();
    }

    protected function doHandle() {
        $activities = Activity::query()
            ->where("start_time", "<=", Carbon::now())
            ->orderBy("end_time", "desc")
            ->limit(50)
            ->get()
            ->toArray();
        foreach ($activities as $activity) {
            $sell_amount = Order::query()
                ->where("activity_id", $activity["id"])
                ->where("status", Order::ORDER_PAID)
                ->sum("actual_price");
            $sell_amount_a = $sell_amount_b = $sell_amount_c = $sell_amount_d = $sell_amount_e = 0;
            $order_detail = OrdersChild::query()
                ->where("activity_id", $activity["id"])
                ->groupBy("type")
                ->selectRaw("sum(price) as price, type")
            ->get()
            ->toArray();
            foreach ($order_detail as $detail) {
                if($detail["type"] == 1) {
                    $sell_amount_a = $detail["price"];
                }
                if($detail["type"] == 2) {
                    $sell_amount_b = $detail["price"];
                }
                if($detail["type"] == 5) {
                    $sell_amount_c = $detail["price"];
                }
                if($detail["type"] == 3) {
                    $sell_amount_d = $detail["price"];
                }
                if($detail["type"] == 4) {
                    $sell_amount_e = $detail["price"];
                }
            }

            $chip_amount = Order::query()
                ->where("activity_id", $activity["id"])
                ->where("status", Order::ORDER_PAID)
                ->where("open_status", Order::OPEN_STATUS_YES)
                ->sum("chip_num_all");
            $chip_amount_a = $chip_amount_b = $chip_amount_c = $chip_amount_d = $chip_amount_e = 0;
            $chip_detail = OrdersChild::query()
                ->where("activity_id", $activity["id"])
                ->where("status", Order::WIN_STATUS)
                ->groupBy("type")
                ->selectRaw("sum(chip_num) as chip_num, type")
                ->get()
                ->toArray();
            foreach ($chip_detail as $detail) {
                if($detail["type"] == 1) {
                    $chip_amount_a = $detail["chip_num"];
                }
                if($detail["type"] == 2) {
                    $chip_amount_b = $detail["chip_num"];
                }
                if($detail["type"] == 5) {
                    $chip_amount_c = $detail["chip_num"];
                }
                if($detail["type"] == 3) {
                    $chip_amount_d = $detail["chip_num"];
                }
                if($detail["type"] == 4) {
                    $chip_amount_e = $detail["chip_num"];
                }
            }

            if($activity["id"] == 1) {
                dd($sell_amount);
            }

            if(!$activity_report = \App\Models\ActivityReport::query()->where("activity_id", $activity["id"])->first()) {
                $activity_report = new \App\Models\ActivityReport();
                $activity_report->activity_id = $activity["id"];
            }
            $activity_report->sell_amount = $sell_amount;
            $activity_report->chip_total = $chip_amount;
            $activity_report->sell_a = $sell_amount_a;
            $activity_report->sell_b = $sell_amount_b;
            $activity_report->sell_c = $sell_amount_c;
            $activity_report->sell_d = $sell_amount_d;
            $activity_report->sell_e = $sell_amount_e;

            $activity_report->chip_a = $chip_amount_a;
            $activity_report->chip_b = $chip_amount_b;
            $activity_report->chip_c = $chip_amount_c;
            $activity_report->chip_d = $chip_amount_d;
            $activity_report->chip_e = $chip_amount_e;
            $activity_report->save();
        }
    }
}
