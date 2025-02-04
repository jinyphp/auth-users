<?php
namespace Jiny\Users;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

use Illuminate\Routing\Router;

class JinyUserServiceProvider extends ServiceProvider
{
    private $package = "jiny-users";
    public function boot()
    {
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        // 데이터베이스
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // 설정파일 복사
        $this->publishes([
            __DIR__.'/../config/setting.php' => config_path('jiny/users/setting.php'),
        ]);


    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {

            Livewire::component('home-user_message',
                \Jiny\Users\Http\Livewire\HomeUserMessage::class);

            Livewire::component('home-user_reviews',
                \Jiny\Users\Http\Livewire\HomeUserReviews::class);

        });

    }

}
