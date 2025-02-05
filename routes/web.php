<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// admin prefix 모듈 검사
if(function_exists('admin_prefix')) {
    $prefix = admin_prefix();
} else {
    $prefix = "admin";
}

## 인증 Admin
Route::middleware(['web','auth:sanctum', 'verified', 'admin'])
->name('admin.auth')
->prefix($prefix.'/auth')->group(function () {


});


## 인증 Admin
Route::middleware(['web','auth:sanctum', 'verified', 'admin'])
->name('admin.auth')
->prefix($prefix.'/auth')->group(function () {
    Route::get('message/{id?}',[
        \Jiny\Users\Http\Controllers\Admin\AdminUserMessage::class,
        'index'])->where('id', '[0-9]+');



});


// Route::middleware(['web'])
// ->name('message')
// ->prefix('/message')->group(function () {
//     // SSE 메시지 테스트
//     Route::get('/',[
//         \Jiny\Users\Http\Controllers\Admin\AdminSseMessage::class,
//         'index']);

// });

// // API 메시지 테스트
// Route::middleware(['web'])
// ->name('api.message')
// ->prefix('/api/message')->group(function () {
//     // SSE 메시지 테스트
//     Route::get('event',[
//         \Jiny\Users\Http\Controllers\Admin\AdminSseMessage::class,
//         'serverEvent']);

// });
