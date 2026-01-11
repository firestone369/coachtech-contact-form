<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;

/*
|--------------------------------------------------------------------------
| Contact（お問い合わせ）
|--------------------------------------------------------------------------
| PG01 /         お問い合わせ入力ページ
| PG02 /confirm  お問い合わせフォーム確認ページ
| PG03 /thanks   サンクスページ
*/

Route::get('/', [ContactController::class, 'form']);
Route::post('contact/confirm', [ContactController::class, 'confirm']);
Route::post('/contact', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

/*
|--------------------------------------------------------------------------
| Admin（管理画面）
|--------------------------------------------------------------------------
| PG04 /admin　管理画面
| PG05 /search　検索
| PG06 /reset　検索リセット
| PG07 /delete　お問い合わせフォーム削除
| PG11 /export　エクスポート
*/

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminContactController::class, 'index']);
    Route::get('/admin/export', [AdminContactController::class, 'export']);
    Route::get('/search', [AdminContactController::class, 'search']);
    Route::get('/reset', [AdminContactController::class, 'reset']);
    Route::post('/delete', [AdminContactController::class, 'delete']);
});