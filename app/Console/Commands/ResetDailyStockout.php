<?php

namespace App\Console\Commands;
use App\Models\Product;
use App\Models\StockoutLog;
use Carbon\Carbon;


use Illuminate\Console\Command;

class ResetDailyStockout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:dailystockout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    $today = Carbon::today();

    $products = Product::where('stockout', '>', 0)->get();

    foreach ($products as $product) {

    StockoutLog::create([
        'product_id' => $product->id,
        'stockout' => $product->stockout,
        'date' => $today,
    ]);

    $product->stockout = 0;
    $product->save(); // ← THIS MUST EXIST
}

    $this->info('Daily stockout reset completed.');
}
}
