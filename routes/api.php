<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostApiController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/test', function(){
//     return array('name'=>"Abhijeet",'surname'=>'kumbhar');

// });/



//  Api Testing
Route::get('/allproduct',[PostApiController::class,'index'])->name('allproduct');
Route::get('/edit/{id}',[PostApiController::class,'edit']);
Route::post('/post',[PostApiController::class,'store']);
Route::put('/update/{id}',[PostApiController::class,'update']);
Route::delete('/delete/{id}',[PostApiController::class,'destroy']);



Route::get('/', [ProductController::class, 'index']);  
Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ProductController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');


