<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');
Route::get('/', function(){
    return Auth::user()->level;
})->middleware('jwt.verify');

Route::get('user', 'PetugasController@getAuthenticatedUser')->middleware('jwt.verify');
Route::delete('deletepetugas/{id}','PetugasController@destroy')->middleware('jwt.verify');
Route::get('showpetugas','PetugasController@show')->middleware('jwt.verify');

//transaksi
Route::get('indextransaksi/{id}','TransaksiController@index')->middleware('jwt.verify');
Route::post('tambahtransaksi','TransaksiController@store')->middleware('jwt.verify');
Route::put('/updatetransaksi/{id}','TransaksiController@update')->middleware('jwt.verify');
Route::delete('deletetransaksi/{id}','TransaksiController@destroy')->middleware('jwt.verify');
Route::get('showtransaksi','TransaksiController@show')->middleware('jwt.verify');

//detail_transaksi
Route::get('indexdetail/{id}','DetailController@index')->middleware('jwt.verify');
Route::post('tambahdetail','DetailController@store')->middleware('jwt.verify');
Route::put('/updatedetail/{id}','DetailController@update')->middleware('jwt.verify');
Route::delete('deletedetail/{id}','DetailController@destroy')->middleware('jwt.verify');
Route::get('showdetail','DetailController@show')->middleware('jwt.verify');

//pembeli
Route::get('indexpembeli/{id}','PembeliController@index')->middleware('jwt.verify');
Route::post('tambahpembeli','PembeliController@store')->middleware('jwt.verify');
Route::put('/updatepembeli/{id}','PembeliController@update')->middleware('jwt.verify');
Route::delete('deletepembeli/{id}','PembeliController@destroy')->middleware('jwt.verify');
Route::get('showpembeli','PembeliController@show')->middleware('jwt.verify');

//jenis
Route::get('indexjenis/{id}','JenisController@index')->middleware('jwt.verify');
Route::post('tambahjenis','JenisController@store')->middleware('jwt.verify');
Route::put('/updatejenis/{id}','JenisController@update')->middleware('jwt.verify');
Route::delete('deletejenis/{id}','JenisController@destroy')->middleware('jwt.verify');
Route::get('showjenis','JenisController@show')->middleware('jwt.verify');

//barang
Route::get('indexbarang/{id}','BarangController@index')->middleware('jwt.verify');
Route::post('tambahbarang','BarangController@store')->middleware('jwt.verify');
Route::put('/updatebarang/{id}','BarangController@update')->middleware('jwt.verify');
Route::delete('deletebarang/{id}','BarangController@destroy')->middleware('jwt.verify');
Route::get('showbarang','BarangController@show')->middleware('jwt.verify');
