<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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
        $subscribers_emails = NewsletterSubscriber::where("is_verified","Yes")->orderBy('email','ASC')->Pluck("email");
        $emails=[];
        $emails = $subscribers_emails;
        print_r($emails);die;
        if(!empty($subscribers_emails)){
            $subject = $request->email_subject;
            $content = $request->email_content;
            $emails = $subscribers_emails;
            Mail::html($content, function ($message) use ($emails,$subject) {
                $message->to($emails)
                    ->subject($subject);
            });
        }
        session()->flash("alert-success","Newsletter send successfully.");
        return redirect()->back();
    }

    public function show($id){
        $subscribers = NewsletterSubscriber::orderBy('name','ASC')->get();
        $data = compact('subscribers');
        return view('admin.newsletters.subscribers',$data);
    }
}
