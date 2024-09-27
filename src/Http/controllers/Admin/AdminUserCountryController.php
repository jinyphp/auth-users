<?php
namespace Jiny\Users\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

/**
 * 가입된 회원의 국가목록을 지정합니다.
 */
use Jiny\WireTable\Http\Controllers\WireTablePopupForms;
//use Jiny\Auth\Http\Controllers\AdminController;
class AdminUserCountryController extends WireTablePopupForms
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ##
        $this->actions['table'] = "user_country"; // 테이블 정보
        $this->actions['paging'] = 10; // 페이지 기본값

        $this->actions['view']['list'] = "jiny-users::admin.country.list";
        $this->actions['view']['form'] = "jiny-users::admin.country.form";

        // 커스텀 레이아웃
        $this->actions['title'] = "회원국가";
        $this->actions['subtitle'] = "회원의 국가 목록을 관리합니다.";
    }



}
