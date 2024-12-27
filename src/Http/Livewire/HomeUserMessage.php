<?php
namespace Jiny\Users\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * 사용자 메시지
 */
class HomeUserMessage extends Component
{
    public $viewFile;

    public function mount()
    {
        $this->viewFile = 'jiny-users::home.message';
    }

    public function render()
    {
        $message = DB::table('user_messages')
            ->paginate(10);
        return view($this->viewFile, [
            'message' => $message
        ]);
    }

}
