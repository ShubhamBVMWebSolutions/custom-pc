<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function submit(Request $request){
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers',
        ]);
        $email = $request->email;
        $randomString = $random = Str::random(40);
        $newsletter = new NewsletterSubscriber();
        $newsletter->email = $request->email;
        $newsletter->token = $randomString;
        $newsletter->save();
        $url = route('newsletter.verify',[base64_encode($newsletter->id),$randomString]);
        $content = "Your email verification link for newsletter is : <a href='$url'>$url</a>";
        Mail::html($content, function ($message) use ($email) {
            $message->to($email)
                ->subject("Newsletter Verify Link");
        });
        session()->flash("success_newletter_submit","Email submitted successfully.");
        return redirect()->back();



    }

    public function verify($id,$token){

    }

}
