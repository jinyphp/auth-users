<?php
namespace Jiny\Users\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

/**
 *
 */
use Jiny\WireTable\Http\Controllers\WireTablePopupForms;
class AdminUserMessage extends WireTablePopupForms
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ##
        $this->actions['table']['name'] = "user_messages"; // 테이블 정보
        $this->actions['paging'] = 10; // 페이지 기본값

        $this->actions['view']['list'] = "jiny-users::admin.message.list";
        $this->actions['view']['form'] = "jiny-users::admin.message.form";

        // 커스텀 레이아웃
        $this->actions['title'] = "회원메시지";
        $this->actions['subtitle'] = "회원의 메시지 목록을 관리합니다.";
    }

    public function index(Request $request)
    {
        $id = $request->id;
        if($id) {
            $this->params['id'] = $id;

            // 회원 계좌 조회 조건
            $this->actions['table']['where'] = [
                'user_id' => $id
            ];
        }

        return parent::index($request);
    }

    /**
     * 신규 데이터 DB 삽입전에 호출됩니다.
     */
    public function hookStoring($wire,$form)
    {
        $user = Auth::user();
        $form['user_id'] = $user->id;
        $form['email'] = $user->email;
        $form['name'] = $user->name;
        $form['status'] = 'new';


        if(isset($form['to_email'])) {
            $user = DB::table('users')
                ->where('email', $form['to_email'])
                ->first();
            $form['user_id'] = $user->id;
        }

        return $form; // 사전 처리한 데이터를 반환합니다.
    }

    /**
     * 데이터 수정전에 호출됩니다.
     */
    public function hookUpdating($wire, $form, $old)
    {
        $user = Auth::user();
        $form['user_id'] = $user->id;
        $form['email'] = $user->email;
        $form['name'] = $user->name;


        if(isset($form['to_email'])) {
            $user = DB::table('users')
                ->where('email', $form['to_email'])
                ->first();
            $form['to_user_id'] = $user->id;
        }

        return $form;
        return true; // 정상
    }



}
