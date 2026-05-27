<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Product;

class ProductController extends Controller
{
    public function sync()
{
    $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vTz7EAg7YH0OocspM64F6qKb-4Nsji6jJ4ySRMDQ8nT8FcK3PysBdmvWMBtr9SN6ToRbAI54UgiAWmC/pub?output=csv";

    $response = Http::withoutVerifying()->get($url);
    $body = $response->body();

    $stream = fopen('php://temp', 'r+');
    fwrite($stream, $body);
    rewind($stream);

    $rows = [];
    while (($row = fgetcsv($stream)) !== false) {
        $rows[] = $row;
    }
    fclose($stream);

    if (count($rows) < 2) return "The sheet is empty.";

    
    $rawHeader = array_shift($rows);
    $header = array_map(function($v) {
        return strtoupper(trim(preg_replace('/\s+/', ' ', $v)));
    }, $rawHeader);
    
    $headerCount = count($header);
    $products = [];

    foreach ($rows as $row) {
        if (empty(array_filter($row))) continue;

        $paddedRow = array_slice(array_pad($row, $headerCount, null), 0, $headerCount);
        $data = array_combine($header, $paddedRow);
        $data = array_map('trim', $data);

        $name = $data['PRODUCT NAME'] ?? '';
        $priceRaw = $data['REGULAR PRICE'] ?? '';

        if (empty($name) || empty($priceRaw)) continue;

        $cleanPrice = str_replace(['₱', ','], '', $priceRaw);

        $products[] = [
            'sheet_id'          => $data['PID(PRODUCT IDENTIFICATION DIGITS)'] ?? null,
            'name'              => $name,
            'category'          => $data['PRODUCT TYPE'] ?? 'Uncategorized',
            'image'             => $data['PRODUCT PICTURE'] ?? null,
            'price'             => floatval($cleanPrice),
            'created_at'        => now(),
            'updated_at'        => now(),
            'card_set_category' => $data['CARD SET CATEGORY'] ?? $data['CARD SET'] ?? null,
            'search_keyword'    => $data['PRODUCT KEYWORDS'] ?? $data['PRODUCT KEYWORD'] ?? null,
        ];
    }

    if (empty($products)) return "No products passed validation.";

    \DB::transaction(function () use ($products) {

    foreach ($products as $data) {

        $product = \App\Models\Product::updateOrCreate(
            ['sheet_id' => $data['sheet_id']],
            $data
        );
    }

});

    return "Successfully synced " . count($products) . " products!";
}
public function salesTrend($id)
{
    $product = \App\Models\Product::findOrFail($id);

    return view('sales-trend', compact('product'));
}
public function trendData($productId,$interval)
{

$query = \App\Models\OrderItem::where('product_id',$productId);

switch($interval){

case 'day':

$rawData = $query->selectRaw('DATE(created_at) as label, COUNT(*) as sales, SUM(qty) as stocks')
    ->groupBy('label')
    ->get()
    ->keyBy('label');

// If no data
if ($rawData->isEmpty()) {
    return response()->json([
        'labels' => [],
        'sales' => [],
        'stocks' => []
    ]);
}

// Date range
$start = \Carbon\Carbon::parse($rawData->keys()->first());
$end = \Carbon\Carbon::parse($rawData->keys()->last());

$period = \Carbon\CarbonPeriod::create($start, $end);

$labels = [];
$sales = [];
$stocks = [];

foreach ($period as $date) {
    $formatted = $date->format('Y-m-d');

    $labels[] = $formatted;

    $sales[] = isset($rawData[$formatted])
        ? $rawData[$formatted]->sales
        : 0;

    $stocks[] = isset($rawData[$formatted])
        ? $rawData[$formatted]->stocks
        : 0;
}

return response()->json([
    'labels' => $labels,
    'sales' => $sales,
    'stocks' => $stocks
]);

case 'week':

$data = $query
->get()
->groupBy(function ($item) {

    $date = \Carbon\Carbon::parse($item->created_at);

    $start = $date->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);
    $end = $date->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

    return $start->format('m/d/Y') . ' - ' . $end->format('m/d/Y');

})
->map(function ($items) {
    return [
        'sales' => $items->count(),
        'stocks' => $items->sum('qty')
    ];
});

return response()->json([
    'labels' => $data->keys(),
    'sales' => $data->pluck('sales'),
    'stocks' => $data->pluck('stocks')
]);

break;

case 'month':
$data = $query->selectRaw('DATE_FORMAT(created_at,"%Y-%m") as label, COUNT(*) as sales, SUM(qty) as stocks')
->groupBy('label')
->get();

return response()->json([
    'labels' => $data->pluck('label'),
    'sales' => $data->pluck('sales'),
    'stocks' => $data->pluck('stocks')
]);
break;

case 'year':
$data = $query->selectRaw('YEAR(created_at) as label, COUNT(*) as sales, SUM(qty) as stocks')
->groupBy('label')
->get();

return response()->json([
    'labels' => $data->pluck('label'),
    'sales' => $data->pluck('sales'),
    'stocks' => $data->pluck('stocks')
]);
break;

}

return response()->json([
'labels'=>$data->pluck('label'),
'sales'=>$data->pluck('sales')
]);

}
}
