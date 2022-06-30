<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Aj_crud_c\Index_c;

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

Route::get('/', [Index_c::class, 'index']);
Route::get('/read', [Index_c::class, 'allData']);
Route::post('/create', [Index_c::class, 'createData']);
Route::get('/find/{id}', [Index_c::class, 'findData']);
Route::post('/update/{id}', [Index_c::class, 'updateData']);
Route::get('/delete/{id}', [Index_c::class, 'deleteData']);
