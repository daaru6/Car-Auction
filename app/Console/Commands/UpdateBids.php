<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Car;

use App\Models\CarBids;

use Carbon\Carbon;

class UpdateBids extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:bids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Decide the winners of the biddings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cars = Car::where('is_sold', false)->whereDate('expiry_date', '<=', Carbon::today()->toDateString())->get();
        foreach ($cars as $car) {
            $highestBid = CarBids::where(['car_id' => $car->car_id, 'is_rejected' => false,'is_paid'=> false])->max('bid_amount');
            if ($highestBid) {
                $winningBid = CarBids::where('car_id', $car->car_id)
                    ->where('bid_amount', $highestBid)
                    ->where('is_rejected', false)
                    ->first();
                if ($winningBid) {
                    $winningBid->is_winner = 1;
                    $winningBid->save();
                }
            }
        }
        $this->info('Successfully updated the winner!');
    }
}
