<?php

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth-test', function () {
        return 'authentication test';
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::get('/dashboard', function () {
    $projects = Project::get(); 
    return [
        'expenses_per_day' => Expense::select(DB::raw('DAYOFYEAR(date) as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as value'))
        ->groupBy(DB::raw('DAYOFYEAR(date)'))->get(), 
        'expenses_per_week' => Expense::select(DB::raw('WEEK(date) as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as value'))
        ->groupBy(DB::raw('YEAR(date)'), DB::raw('WEEK(date)'))
        ->get(),
        'expenses_per_month' => Expense::select(DB::raw('MONTH(date) as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as value'))
        ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'))
        ->get(), 
        'expenses_per_year' => Expense::select(DB::raw('YEAR(date) as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as value'))
        ->groupBy(DB::raw('YEAR(date)'))
        ->get(), 
        'project_per_day' => Project::select(DB::raw('DATE(start_date) as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(budget) as value'))
        ->groupBy(DB::raw('DATE(start_date)'), DB::raw('DATE(start_date)'))->get(), 
        'project_per_week' => Project::select(DB::raw('WEEK(start_date) as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(budget) as value'))
        ->groupBy(DB::raw('YEAR(start_date)'), DB::raw('WEEK(start_date)'))
        ->get(),
        'project_per_month' => Project::select(DB::raw('MONTH(start_date) as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(budget) as value'))
        ->groupBy(DB::raw('YEAR(start_date)'), DB::raw('MONTH(start_date)'))
        ->get(), 
        'project_per_year' => Project::select(DB::raw('YEAR(start_date) as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(budget) as value'))
        ->groupBy(DB::raw('YEAR(start_date)'))
        ->get(), 
        'category_expenses_per_day' => Project::select(DB::raw('category_id as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(budget) as value'))
        ->groupBy(DB::raw('DATE(start_date)'), DB::raw('category_id'))->get(), 
        'category_expenses_per_week' => Project::select(DB::raw('category_id as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(budget) as value'))
        ->groupBy(DB::raw('YEAR(start_date)'), DB::raw('WEEK(start_date)'), DB::raw('category_id'))
        ->get(),
        'category_expenses_per_month' => Project::select(DB::raw('category_id as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(budget) as value'))
        ->groupBy(DB::raw('YEAR(start_date)'), DB::raw('MONTH(start_date)'), DB::raw('category_id'))
        ->get(), 
        'category_expenses_per_year' => Project::select(DB::raw('category_id as label'), DB::raw('COUNT(*) as count'), DB::raw('SUM(budget) as value'))
        ->groupBy(DB::raw('YEAR(start_date)'), DB::raw('category_id'))
        ->get(), 
        'projects' => $projects, 
    ];
});
