<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function subscribers_list(){
        $subscribers = NewsletterSubscriber::orderBy('name','ASC')->get();
        $data = compact('subscribers');
        return view('admin.newsletters.subscribers',$data);
    }
}
