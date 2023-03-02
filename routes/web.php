<?php

use Carbon\Carbon;
use App\Models\General;
use App\Models\Children;
use App\Models\Pregnant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\FamilyHouseholdProfile;
use App\Http\Controllers\PwdController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\PregnantController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\HealthProblemController;
use App\Http\Controllers\HeadOfTheFamilyController;
use App\Http\Controllers\HouseHoldProfileController;
use App\Models\HeadOfTheFamily;
use App\Models\HealthProblem;
use App\Models\Pwd;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::prefix('/users')->name('users.')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::get('/create', [UsersController::class, 'create'])->name('create');
    Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('edit');
    Route::get('/{user}', [UsersController::class, 'show'])->name('show');
    Route::put('/{user}', [UsersController::class, 'update'])->name('update');
    Route::post('/', [UsersController::class, 'store']);
});

Route::prefix('/announcements')->name('announcements.')->group(function () {
    Route::get('/', [AnnouncementController::class, 'index'])->name('index');
    Route::get('/create', [AnnouncementController::class, 'create'])->name('create');
    Route::post('/', [AnnouncementController::class, 'store']);
});

Route::prefix('/profiles')->name('profiles.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/create', [ProfileController::class, 'create'])->name('create');
    Route::get('/{profile}/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::get('/{profile}', [ProfileController::class, 'show'])->name('show');
    Route::put('/{profile}', [ProfileController::class, 'update'])->name('update');
    Route::post('/', [ProfileController::class, 'store']);
});

Route::prefix('/pwd')->name('pwd.')->group(function () {
    Route::get('/', [PwdController::class, 'index'])->name('index');
    Route::get('/create', [PwdController::class, 'create'])->name('create');
    Route::get('/{pwd}/edit', [PwdController::class, 'edit'])->name('edit');
    Route::get('/{pwd}', [PwdController::class, 'show'])->name('show');
    Route::put('/{pwd}', [PwdController::class, 'update'])->name('update');
    Route::post('/', [PwdController::class, 'store']);
});

Route::prefix('/generals')->name('generals.')->group(function () {
    Route::get('/', [GeneralController::class, 'index'])->name('index');
    Route::get('/create', [GeneralController::class, 'create'])->name('create');
    Route::get('/{general}/edit', [GeneralController::class, 'edit'])->name('edit');
    Route::get('/{general}', [GeneralController::class, 'show'])->name('show');
    Route::put('/{general}', [GeneralController::class, 'update'])->name('update');
    Route::post('/', [GeneralController::class, 'store']);
});

Route::prefix('/pregnants')->name('pregnants.')->group(function () {
    Route::get('/', [PregnantController::class, 'index'])->name('index');
    Route::get('/create', [PregnantController::class, 'create'])->name('create');
    Route::get('/{pregnant}/edit', [PregnantController::class, 'edit'])->name('edit');
    Route::get('/{pregnant}', [PregnantController::class, 'show'])->name('show');
    Route::put('/{pregnant}', [PregnantController::class, 'update'])->name('update');
    Route::post('/', [PregnantController::class, 'store']);
});

Route::prefix('/head-of-the-family')->name('headOfTheFamilies.')->group(function () {
    Route::get('/', [HeadOfTheFamilyController::class, 'index'])->name('index');
    Route::get('/create', [HeadOfTheFamilyController::class, 'create'])->name('create');
    Route::get('/{headOfTheFamily}/edit', [HeadOfTheFamilyController::class, 'edit'])->name('edit');
    Route::get('/{headOfTheFamily}', [HeadOfTheFamilyController::class, 'show'])->name('show');
    Route::put('/{headOfTheFamily}', [HeadOfTheFamilyController::class, 'update'])->name('update');
    Route::post('/', [HeadOfTheFamilyController::class, 'store']);
});

Route::prefix('/health-problems')->name('healthProblems.')->group(function () {
    Route::get('/', [HealthProblemController::class, 'index'])->name('index');
    Route::get('/create', [HealthProblemController::class, 'create'])->name('create');
    Route::get('/{healthProblem}/edit', [HealthProblemController::class, 'edit'])->name('edit');
    Route::get('/{healthProblem}', [HealthProblemController::class, 'show'])->name('show');
    Route::put('/{healthProblem}', [HealthProblemController::class, 'update'])->name('update');
    Route::post('/', [HealthProblemController::class, 'store']);
});

Route::prefix('/children')->name('children.')->group(function () {
    Route::get('/', [ChildrenController::class, 'index'])->name('index');
    Route::get('/create', [ChildrenController::class, 'create'])->name('create');
    Route::get('/{children}/edit', [ChildrenController::class, 'edit'])->name('edit');
    Route::get('/{children}', [ChildrenController::class, 'show'])->name('show');
    Route::put('/{children}', [ChildrenController::class, 'update'])->name('update');
    Route::post('/', [ChildrenController::class, 'store']);
});

Route::prefix('/house-hold-profile')->name('hh.')->group(function () {
    Route::get('/', [HouseHoldProfileController::class, 'index'])->name('index');
    Route::get('/create', [HouseHoldProfileController::class, 'create'])->name('create');
    Route::get('/{hh}/edit', [HouseHoldProfileController::class, 'edit'])->name('edit');
    Route::get('/{hh}', [HouseHoldProfileController::class, 'show'])->name('show');
    Route::put('/{hh}', [HouseHoldProfileController::class, 'update'])->name('update');
    Route::post('/', [HouseHoldProfileController::class, 'store']);
    Route::post('/toggle-profile/{hh}', [HouseHoldProfileController::class, 'toggleProfile'])->name('toggle');
});


Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::delete('/destroy/{id}', function (Request $request, $id) {
    $model = $request->model;
    ("\\App\\Models\\$model")::find($id)->delete();

    alert()->success('Resource has been deleted!');

    return back();
})->name('destroy');

Route::get('/test', function () {
    return 'test';
});


Route::get('/archive', function (Request $request) {
    $model = $request->type;
    $id = $request->id;
    ("\\App\\Models\\$model")::find($id)->delete();

    alert()->success('Resource has been deleted!');

    return back();
});


function formatReport($records, $currentYear = null) {
    if ($currentYear == null) {
        $currentYear = now()->year;
    }
    $formattedRecords = [];
    foreach ($records as $record) {
        $monthName = Carbon::createFromDate($currentYear, $record->month, 1)->format('F');
        $formattedRecords[$monthName] = $record->count;
    }

    return $formattedRecords;
}

function getReports($model) {
    $reports = ($model)::select(DB::raw('MONTH(created_at) month, COUNT(*) count'))
    ->whereYear('created_at', now()->year)
    ->groupBy('month')
    ->orderBy('month')
    ->get();
    return formatReport($reports);
}

Route::get('/reports', function (Request $request) {

    $patients = [];
    $pregnants = [];
    $children = [];
    $household = [];
    $pwds = [];
    $headOfTheFamilies = [];
    $healthProblems = [];


    $patientReport = getReports(General::class);
    $pregnantReport = getReports(Pregnant::class);
    $childrenReport = getReports(Children::class);
    $householdReport = getReports(FamilyHouseholdProfile::class);

    if ($request->from && $request->to) {
        $patients = General::whereBetween('created_at', [$request->from, $request->to])->get();
        $pregnants = Pregnant::whereBetween('created_at', [$request->from, $request->to])->get();
        $children = Children::whereBetween('created_at', [$request->from, $request->to])->get();
        $household = FamilyHouseholdProfile::whereBetween('created_at', [$request->from, $request->to])->get();
        $pwds = Pwd::whereBetween('created_at', [$request->from, $request->to])->get();
        $headOfTheFamilies = HeadOfTheFamily::whereBetween('created_at', [$request->from, $request->to])->get();
        $healthProblems = HealthProblem::whereBetween('created_at', [$request->from, $request->to])->get();
    }


    return view('reports', compact('pwds', 'headOfTheFamilies', 'healthProblems', 'patients', 'pregnants', 'children', 'household','patientReport', 'pregnantReport', 'childrenReport', 'householdReport'));
});
