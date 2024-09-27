<?php
namespace Jiny\Users\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * 회원 데시보드
 */
use Jiny\WireTable\Http\Controllers\SiteDashboard;
class Dashboard extends SiteDashboard
{
    use \Jiny\WireTable\Http\Trait\Permit;
    //use \Jiny\Table\Http\Controllers\SetMenu;

    public function __construct()
    {
        parent::__construct();  // setting Rule 초기화
        $this->setVisit($this); // Livewire와 양방향 의존성 주입

        $this->actions['view']['main'] = "jiny-users::admin.dashboard.dashboard";

        $this->actions['title'] = "회원";

    }

    public function index(Request $request)
    {
        // Request값 Action 병합
        $this->checkRequestNesteds($request);
        $this->checkRequestQuery($request);

        // 메뉴 설정
        ##$this->menu_init();

        // 권한
        $this->permitCheck();
        if($this->permit['read']) {
            $view = $this->checkMainView();

            // 오늘 가입회원
            $userInfo = [];
            $userInfo['total'] = DB::table('users')->count();
            $userInfo['today'] = DB::table('users')
                ->where('created_at',">", date("Y-m-d 00:00:00"))
                ->count();

            $userAdmin = DB::table('users_admin')->count();
            $userSuper = DB::table('users_super')->count();

            $authInfo = [];
            $authInfo['total'] = DB::table('users_auth')->count();
            $authInfo['today'] = DB::table('users_auth')
                ->where('created_at',">", date("Y-m-d 00:00:00"))
                ->count();


            $counts = DB::table('users')->select(DB::raw('count(id) as total_count, count(auth) as auth_count, count(sleeper) as sleeper_count'))->get();




// 1년 전의 날짜 계산
$oneYearAgo = Carbon::now()->subYear();

// Controller에서 데이터 가져오기
$monthlyMembers = DB::table('users')
    ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total'))
    ->where('created_at', '>=', $oneYearAgo)
    ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
    ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
    ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
    ->get();

// 1년간의 일별 데이터 쿼리
$dailyMembers = DB::table('users')
    ->select(DB::raw('DATE(created_at) as date, COUNT(*) as total'))
    ->where('created_at', '>=', $oneYearAgo)
    ->groupBy(DB::raw('DATE(created_at)'))
    ->orderBy(DB::raw('DATE(created_at)'), 'ASC')
    ->get();



            return view($view,[
                'actions' => $this->actions,
                'request' => $request,

                'userInfo' => $userInfo,
                'userAdmin' => $userAdmin,
                'userSuper' => $userSuper,

                'authInfo' => $authInfo,

                'monthlyMembers' => $monthlyMembers,
                'dailyMembers' => $dailyMembers,


                "total_count" => $counts[0]->total_count,
                "auth_count" => $counts[0]->auth_count,
                "sleeper_count"=> $counts[0]->sleeper_count
            ]);
        }


        // 권한 접속 실패
        return view("jinytable::error.permit",[
            'actions' => $this->actions,
            'request' => $request
        ]);
    }

    private function checkMainView()
    {
        // 메인뷰 페이지...
        if (isset($this->actions['view']['main'])) {
            if (view()->exists($this->actions['view']['main']))
            {
                return $this->actions['view']['main'];
            }
        }

        return "jinytable::main";
    }


}
