<?php

namespace App\Console\Commands;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DailyRestockProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:restockproducts';

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

    $products = Product::where('current_stock', 0)->get();

    foreach ($products as $product) {

        // Prevent double restock
        if ($product->last_restocked_at == $today->toDateString()) {
            continue;
        }

        $product->update([
            'current_stock' => $product->default_stock,
            'last_restocked_at' => $today,
        ]);
    }

    $this->info('Daily restock completed.');
}
}
