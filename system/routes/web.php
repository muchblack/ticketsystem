<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/test/',function(){
//    $array = [
//        'role' =>[
//            'Report'=>[
//                'action' => true,
//                'reslove' => false,
//            ],
//            'Feature'=>[
//                'action' => true,
//                'reslove' => false,
//            ],
//            'Test'=>[
//                'action' => true,
//                'reslove' => false,
//            ]
//        ]
//    ];
//
//    dd(json_encode($array));
//});

Route::get('/{any}',function() {
    return view('app');
})->where('any','.*');


