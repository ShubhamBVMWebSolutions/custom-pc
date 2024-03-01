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
        $subscribers = NewsletterSubscriber::orderBy('name','ASC')->get();
        $data = compact('subscribers');
        return view('admin.newsletters.subscribers',$data);
    }

    public function send(Request $request){
        $subscribers = NewsletterSubscriber::orderBy('name','ASC')->get();
        $data = compact('subscribers');
        return view('admin.newsletters.subscribers',$data);
    }

    public function show($id){
        $subscribers = NewsletterSubscriber::orderBy('name','ASC')->get();
        $data = compact('subscribers');
        return view('admin.newsletters.subscribers',$data);
    }
}
