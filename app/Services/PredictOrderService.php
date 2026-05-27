<?php

namespace App\Services;

use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Prediction;
use Phpml\Regression\LeastSquares;
use Carbon\Carbon;
use Exception;
use Log;

class PredictOrderService
{
    /**
     * Predict future sales and provide stock recommendations.
     *
     * @param int $product_id
     * @param string $period ('day', 'week', 'month', 'year')
     * @param int $predict_intervals Number of future intervals to predict
     * @param int $safetyMargin Optional safety margin to avoid stockouts
     * @return array|null
     */
    public function predict($product_id, $period = 'day', $predict_intervals = 1, $safetyMargin = 10)
    {
        try {
            $product = Product::findOrFail($product_id);
            $alpha = $product->stockout ?? 0;

            // --- 1. FETCH SALES BASED ON PERIOD -------------------------
            $sales = OrderItem::selectRaw("
                SUM(qty) as total_qty,
                CASE
                    WHEN '$period' = 'day' THEN DATE(created_at)
                    WHEN '$period' = 'week' THEN YEARWEEK(created_at)
                    WHEN '$period' = 'month' THEN DATE_FORMAT(created_at, '%Y-%m')
                    WHEN '$period' = 'year' THEN YEAR(created_at)
                END as period
            ")
            ->where('product_id', $product_id)
            ->groupBy('period')
            ->orderBy('period')
            ->get();

            if ($sales->isEmpty()) {
                return null;
            }

            $start = $sales->first()->period;
            $end   = $sales->last()->period;

            // --- 2. GENERATE INTERVALS ---------------------------------
            $intervals = $this->generateIntervals($period, $start, $end, $predict_intervals);

            // --- 3. PREPARE DATA FOR TRAINING --------------------------
            $_period = [];
            $_orders = [];
            $index = 1;

            foreach ($sales as $sale) {
                $_period[] = $index++;
                $_orders[] = $sale->total_qty ?? 0;
            }

            $samples = array_map(fn($d) => [$d], $_period);

            // --- 4. TRAIN REGRESSION MODEL -----------------------------
            $regression = new LeastSquares();
            $regression->train($samples, $_orders);

            // --- 5. PREDICT FUTURE INTERVALS ---------------------------
            $predictions = [];
            $lastIndex = $_period[count($_period) - 1];

            $actualSales = $_orders[count($_orders) - 1] ?? 0;

            for ($i = 0; $i < $predict_intervals; $i++) {
                
                //Linear or Polynomial Regression
                $predicted_qty = $regression->predict([$lastIndex + $i + 1]);

                // Lost demand heuristic
                $lostDemand = max(0, ($predicted_qty - $actualSales) * $alpha);
                
                //Requirement Planning
                $recommendedStock = max(0,($predicted_qty + $lostDemand) - $product->current_stock + $safetyMargin);

                $predictions[] = [
                'period' => $intervals[count($sales) + $i],
                'sales_quantity' => $predicted_qty,
                'stock_recommendation' => (int) $recommendedStock,
                ];
            }

            // --- 6. SAVE PREDICTIONS ----------------------------------
            $results = [];
            foreach ($predictions as $p) {
                $results[] = Prediction::updateOrCreate(
                    [
                        'product_id'     => $product_id,
                        'prediction_for' => $p['period'],
                        'interval'       => $period,
                    ],
                    [
                        'sales_quantity'       => $p['sales_quantity'],
                        'stock_recommendation' => $p['stock_recommendation'],
                    ]
                );
            }

            return $results;

        } catch (Exception $error) {
            Log::error('Prediction failed: ' . $error->getMessage());
            return null;
        }
    }

    /**
     * Generate time intervals for prediction
     */
    private function generateIntervals($period, $start, $end, $predict_intervals)
    {
        $intervals = [];

        if ($period === 'day') {
            $current = Carbon::parse($start);
            $endDate = Carbon::parse($end);

            while ($current->lte($endDate)) {
                $intervals[] = $current->toDateString();
                $current->addDay();
            }

            for ($i = 0; $i < $predict_intervals; $i++) {
                $intervals[] = $current->toDateString();
                $current->addDay();
            }
        } elseif ($period === 'week') {
            $current = Carbon::parse($start . ' Sunday');
            $endDate = Carbon::parse($end . ' Sunday');

            while ($current->lte($endDate)) {
                $intervals[] = $current->format('oW');
                $current->addWeek();
            }

            for ($i = 0; $i < $predict_intervals; $i++) {
                $intervals[] = $current->format('oW');
                $current->addWeek();
            }
        } elseif ($period === 'month') {
            $current = Carbon::parse($start . '-01');
            $endDate = Carbon::parse($end . '-01');

            while ($current->lte($endDate)) {
                $intervals[] = $current->format('Y-m');
                $current->addMonth();
            }

            for ($i = 0; $i < $predict_intervals; $i++) {
                $intervals[] = $current->format('Y-m');
                $current->addMonth();
            }
        } elseif ($period === 'year') {
            $current = Carbon::createFromDate($start);
            $endDate = Carbon::createFromDate($end);

            while ($current->lte($endDate)) {
                $intervals[] = $current->format('Y');
                $current->addYear();
            }

            for ($i = 0; $i < $predict_intervals; $i++) {
                $intervals[] = $current->format('Y');
                $current->addYear();
            }
        }

        return $intervals;
    }
}
