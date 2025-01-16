<?php

namespace App\Http\Controllers\Messages;

use App\Events\MessagesEvent;
use App\Http\Controllers\Controller;
use App\Models\Messenger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{

    public function sendTheMessage(Request $request, $id)
    {
        $message = $request->message;
        $obj = new Messenger();
        $obj->message = $message;
        $obj->id_user_send = $request->user()->id;
        $obj->id_user_revice = $id;
        $obj->save();
        broadcast(new MessagesEvent(Auth::user(), User::find($id), $message));
        return $obj;
    }
    public function chatList()
    {
        $user = User::where('id', '<>', Auth::id())->where('type', '!=', 'admin')->get();
        return view('admin.chat.boxchat', compact('user'));
    }
    public function chatSuport($id)
    {
        $user = User::where('id', '<>', Auth::id())->where('type', '!=', 'admin')->get();
        $user_select = User::find($id);
        $messages = Messenger::where(function ($query) use ($id) {
            $query->where('id_user_revice', $id)
                ->where('id_user_send', Auth::id());
        })->orWhere(function ($query) use ($id) {
            $query->where('id_user_send', $id)
                ->where('id_user_revice', Auth::id());
        })->get();

        return view('admin.chat.chat', compact('user','user_select','messages'));
    }
}
