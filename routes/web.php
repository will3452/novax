<?php

use App\Models\Branch;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', Nova::path());

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});


Route::get('/report', function () {
    $branches = Branch::get();
        $series = [];
        foreach ($branches as $branch) {
            $items = $branch->counsellings()->whereYear('created_at', date('Y'))->get()->groupBy(function ($q) {
                return $q->created_at->format('m');
            });

            $data = [];

            for ($i = 1; $i <= 12; $i++) {
                $i = $i <= 9 ? "0" . $i : $i;
                $data[] = array_key_exists($i, $items->all()) ? count($items->all()[$i]) : 0;
            }

            $series[] = [
                'barPercentage' => 1,
                'label' => $branch->name,
                'borderColor' => sprintf("#%06x", rand(0, 16777215)),
                'data' => $data,
            ];
        }
    return view('report', compact('series'));
});
