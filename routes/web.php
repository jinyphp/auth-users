<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// 지니어드민 패키지가 설치가 되어 있는 경우에만 실행
if(function_exists("isAdminPackage")) {

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

        Route::resource('users',\Jiny\Users\Http\Controllers\Admin\UserController::class);
        //Route::resource('roles',\Jiny\Users\Http\Controllers\Admin\RoleController::class);

        Route::resource('reserved',\Jiny\Users\Http\Controllers\Admin\ReservedController::class);
        Route::resource('blacklist',\Jiny\Users\Http\Controllers\Admin\AdminUserBlacklistController::class);

        Route::get('logs/{id}',[
            \Jiny\Users\Http\Controllers\Admin\AdminUserLogController::class,
            "index"])->where('id', '[0-9]+');

        Route::resource('grade',\Jiny\Users\Http\Controllers\Admin\AdminUserGradeContoller::class);

        Route::resource('sleeper',\Jiny\Users\Http\Controllers\Admin\AdminUserSleeperContoller::class);
        Route::resource('confirm',\Jiny\Users\Http\Controllers\Admin\AdminUserConfirmContoller::class);

        // 패스워드 유효기간 연장
        Route::get('password',[
            \Jiny\Users\Http\Controllers\Admin\AdminUserPasswordContoller::class,
            'index']);

        Route::get('locale',[
            \Jiny\Users\Http\Controllers\Admin\AdminUserLocaleContoller::class,
            'index']);



        Route::resource('country', \Jiny\Users\Http\Controllers\Admin\AdminUserCountryController::class);
        Route::resource('social', \Jiny\Users\Http\Controllers\Admin\SocialController::class);

        // 사이트 데쉬보드
        Route::get('/', [\Jiny\Users\Http\Controllers\Admin\Dashboard::class, "index"]);

    });
}

