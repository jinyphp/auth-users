<?php
namespace Jiny\Users\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

/**
 * 회원등급
 */
use Jiny\WireTable\Http\Controllers\WireTablePopupForms;
class AdminUserGradeContoller extends WireTablePopupForms
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ##
        $this->actions['table'] = "user_grade";
        $this->actions['paging'] =  "10";

        $this->actions['view']['list'] = "jiny-users::admin.grade.list";
        $this->actions['view']['form'] = "jiny-users::admin.grade.form";

        //$this->actions['role'] = true;
        $this->actions['title'] = "회원등급";
        $this->actions['subtitle'] = "회원의 등급을 지정합니다.";
    }

    // role당 사용자 수 계산출력
    public function hookIndexed($wire, $rows)
    {
        /*
        $cnt = [];
        $roles = DB::table('role_user')->get();
        foreach($roles as $role) {
            $role_id = $role->role_id;
            if(isset($cnt[$role_id])) {
                $cnt[$role_id]++;
            } else {
                $cnt[$role_id] = 1;
            }
        }

        foreach($rows as $key => $row)
        {
            $id = $row->id;
            if(isset($cnt[$id])) {
                $rows[$key]->cnt = $cnt[$id];
            } else {
                $rows[$key]->cnt = 0;
            }
        }
        */

        return $rows;

    }

}
