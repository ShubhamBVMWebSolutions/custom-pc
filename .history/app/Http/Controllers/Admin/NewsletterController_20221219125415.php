<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function subscribers(){
        $subscribers = NewsletterSubscriber::orderBy('email','ASC')->get();
        $data = compact('subscribers');
        return view('admin.newsletters.subscribers',$data);
    }

    public function list(){
        $subscribers = NewsletterSubscriber::orderBy('name','ASC')->get();
        $data = compact('subscribers');
        return view('admin.newsletters.subscribers',$data);
    }

    public function create(){
        return view('admin.newsletters.create');
    }

    public function send(Request $request){
        $validated = $request->validate([
            'email_subject' => 'required',
            'email_content' => 'required',
        ]);
        $subscribers = NewsletterSubscriber::where("is_verified","Yes")->orderBy('email','ASC')->get();
        dd($subscribers);
    }

    public function show($id){
        $subscribers = NewsletterSubscriber::orderBy('name','ASC')->get();
        $data = compact('subscribers');
        return view('admin.newsletters.subscribers',$data);
    }
}
