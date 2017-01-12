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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/360/perks/gift-certificates', 'Perks\GiftCertificatesController@apiGetPerksGiftCertificates');
Route::get('/360/perks/gift-certificates/{id}', 'Perks\GiftCertificatesController@apiGetUserPerksGiftCertificates')->where('id', '[0-9]+');
Route::post('/360/perks/gift-certificates/{id}', 'Perks\GiftCertificatesController@apiPostPerksGiftCertificates')->where('id', '[0-9]+');
