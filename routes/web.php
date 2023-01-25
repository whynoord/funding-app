<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\AccFundController;

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

Route::get('/detail', function () {
    return view('detail');
})->name('detail');

Route::get('/rincian/{id}', [FundController::class, 'index'])->name('rincian');
Route::get('/detail/{id}', [ProposalController::class, 'show'])->name('detail');
Route::get('/', [ProposalController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::post('/buat-proposal/simpan', [ProposalController::class, 'store'])->name('simpanProposal');
    Route::get('/buat-proposal', [ProposalController::class, 'create'])->name('buatProposal');
    Route::get('/edit-proposal/{id}', [ProposalController::class, 'edit'])->name('editProposal');
    Route::post('/edit-proposal/{id}/update', [ProposalController::class, 'update'])->name('updateProposal');
    Route::get('/akun', [UserController::class, 'index'])->name('akun');
    Route::get('/kirim-dana/{id}', [ProposalController::class, 'kirim_dana'])->name('kirimDana');
    Route::post('/kirim-dana/update/{id}', [ProposalController::class, 'update_collected'])->name('updateCollected');
});

Auth::routes();

