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
        // 회원등급
        Route::get('grade',[
            \Jiny\Users\Http\Controllers\Admin\AdminUserGradeContoller::class,
            "index"]);

        // 권한
        Route::get('roles',[
            \Jiny\Users\Http\Controllers\Admin\RoleController::class,
            "index"]);

        // 휴면회원
        Route::get('sleeper',[
            \Jiny\Users\Http\Controllers\Admin\AdminUserSleeperContoller::class,
            "index"]);

        // 회원제한 : 예약어
        Route::get('reserved',[
            \Jiny\Users\Http\Controllers\Admin\ReservedController::class,
            "index"]);

        // 회원제한 : 블렉리스트
        Route::get('blacklist',[
            \Jiny\Users\Http\Controllers\Admin\AdminUserBlacklistController::class,
            "index"]);


        // 확인
        Route::get('confirm',[
            \Jiny\Users\Http\Controllers\Admin\AdminUserConfirmContoller::class,
            "index"]);



        // 지역
        Route::get('locale',[
            \Jiny\Users\Http\Controllers\Admin\AdminUserLocaleContoller::class,
            'index']);

        // 회원 국가
        Route::get('/country',[
            \Jiny\Users\Http\Controllers\Admin\AdminUserCountryController::class,
            'index']);


        Route::get('logs/{id}',[
            \Jiny\Users\Http\Controllers\Admin\AdminUserLogController::class,
            "index"])->where('id', '[0-9]+');

        // 패스워드 유효기간 연장
        Route::get('password',[
            \Jiny\Users\Http\Controllers\Admin\AdminUserPasswordContoller::class,
            'index']);

        Route::resource('social', \Jiny\Users\Http\Controllers\Admin\SocialController::class);

        // 사이트 데쉬보드
        //Route::get('/', [\Jiny\Users\Http\Controllers\Admin\Dashboard::class, "index"]);

    });
}

