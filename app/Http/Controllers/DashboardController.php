<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return [
            'expenses_per_day' => Expense::select(DB::raw('DATE(date) as date'), DB::raw('SUM(amount) as total'))
                ->groupBy('date')
                ->get(),
            'expenses_per_category' => Category::with('expenses')->get(),
            'expenses_per_project' => Project::with('expenses')->get(),
        ];
    }
}
