<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, BorrowController, HistoryController, PrintController, EmployeeController, SendemailController};

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home.index')->middleware('allowip');
Route::get('/home/search', [HomeController::class, 'search'])->name('home.search')->middleware('allowip');

Route::get('/borrow', [BorrowController::class, 'index'])->name('borrow.index')->middleware('allowip');

Route::get('/borrow/fd', [BorrowController::class, 'createFd'])->name('borrow.fd')->middleware('allowip');
Route::post('/borrow/fd/store', [BorrowController::class, 'storeFd'])->name('borrow.storeFd')->middleware('allowip');

Route::get('/borrow/laptop', [BorrowController::class, 'createLaptop'])->name('borrow.laptop')->middleware('allowip');
Route::post('/borrow/laptop/store', [BorrowController::class, 'storeLaptop'])->name('borrow.storeLaptop')->middleware('allowip');

Route::get('/borrow/pointer', [BorrowController::class, 'createPointer'])->name('borrow.pointer')->middleware('allowip');
Route::post('/borrow/pointer/store', [BorrowController::class, 'storePointer'])->name('borrow.storePointer')->middleware('allowip');

Route::get('/borrow/jabra', [BorrowController::class, 'createJabra'])->name('borrow.jabra')->middleware('allowip');
Route::post('/borrow/jabra/store', [BorrowController::class, 'storeJabra'])->name('borrow.storeJabra')->middleware('allowip');

Route::get('/borrow/headphone', [BorrowController::class, 'createHeadphone'])->name('borrow.headphone')->middleware('allowip');
Route::post('/borrow/headphone/store', [BorrowController::class, 'storeHeadphone'])->name('borrow.storeHeadphone')->middleware('allowip');

Route::get('/borrow/saramonic', [BorrowController::class, 'createSaramonic'])->name('borrow.saramonic')->middleware('allowip');
Route::post('/borrow/saramonic/store', [BorrowController::class, 'storeSaramonic'])->name('borrow.storeSaramonic')->middleware('allowip');

Route::get('/borrow/{id}/return', [BorrowController::class, 'returnAsset'])->name('borrow.return')->where('id', '[0-9]+')->middleware('allowip');
Route::put('/borrow/returned', [BorrowController::class, 'returnAssetUpdate'])->name('borrow.returned')->middleware('allowip');

Route::get('/history', [HistoryController::class, 'index'])->name('history.index')->middleware('allowip');
Route::get('/history/report', [HistoryController::class, 'downloadReportHistory'])->name('history.report')->middleware('allowip');
Route::get('/history/search', [HistoryController::class, 'searchHistory'])->name('history.search')->middleware('allowip');


Route::get('/print', [PrintController::class, 'index'])->name('print.index')->middleware('allowip');
Route::get('/print/add', [PrintController::class, 'add'])->name('print.add')->middleware('allowip');
Route::post('/print/store', [PrintController::class, 'store'])->name('print.store')->middleware('allowip');
Route::get('/print/report', [PrintController::class, 'downloadReportPrint'])->name('print.report')->middleware('allowip');
Route::get('/print/search', [PrintController::class, 'search'])->name('print.search')->middleware('allowip');

Route::get('/sendemail', [SendemailController::class, 'sendEmail'])->name('sendemail')->middleware('allowip'); //send email automaticly using interval jquery in template  app.blade.php 


Route::get('/employee/getnik', [EmployeeController::class, 'getDataByNik'])->name('employee.getnik')->middleware('allowip');
