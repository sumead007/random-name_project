<?php

use App\Http\Controllers\HomeController;
use App\Models\Customer;
use App\Models\RandomDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return view('auth.login');
    }
});

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::post('/magate/custommer/addOrUpdate', [HomeController::class, 'store'])->name('magate.custommer.addOrUpdate');
    Route::get('/magate/custommer/getData/{id}', [HomeController::class, 'getData']);
    Route::delete('/magate/custommer/delete/{id}', [HomeController::class, 'deletePost']);
    Route::post('/random', [HomeController::class, 'random'])->name('random');
    Route::post('/random/saveRandom/', [HomeController::class, 'saveRandom'])->name('random.saveRandom');
    Route::post('/magate/custommer/delete_all/', [HomeController::class, 'deleteAll'])->name('magate.custommer.delete_all');
    Route::get('/history/random', [HomeController::class, 'viewHistory'])->name('history.random');

    Route::get('/test', function (Request $request) {
        // $full_data = array();
        // $customers = Customer::all();
        // $random_detail = RandomDetail::all();
        // $data_save = array();
        // for ($i = 0; $i < count($customers); $i++) {
        //     $chk = 0;
        //     foreach ($random_detail as $random) {
        //         if ($customers[$i]->id == (int)$random->cus_id) {
        //             $chk = 1;
        //         }
        //     }
        //     if ($chk == 0) {
        //         $data_save[] = $customers[$i];
        //     }
        // }
        // dd($data_save);
        $request->session()->forget('randomDetail');
    });
});
