<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\User;
use App\Http\Requests\ReplyRequest;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReplyRequest $request, Reply $reply)
    {
        $reply->content = $request->input('content');
        $usernameat = matching($reply->content,'@',' ');
        $content = '';
        foreach ($usernameat as $val) {
            $username = get_between($val, '@', ' ');
            $uid = User::where('name',$username)->pluck('id')->toarray();
            if($uid){
                $replace = "<a href='/users/".$uid[0]."' title='"."$username'>@".$username."</a> ";
                $reply->content = str_replace($val,$replace,$reply->content);
            }
        }
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();

        return redirect()->to($reply->topic->link())->with('success', '创建成功！');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);
        $reply->delete();

        return redirect()->to($reply->topic->link())->with('success', '成功删除回复！');
    }
}