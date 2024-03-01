<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;

class ConversationController extends Controller
{
    public function index(){
        $conversations = Conversation::orderBy('id','Desc')->get();
    	$data = compact('conversations');
        return view('admin.conversations.index',$data);
    }
}
