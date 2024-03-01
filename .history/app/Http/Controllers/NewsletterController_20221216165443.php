<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function submit(Request $request){
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers ',
        ]);

        return redirect()->back();

    }

}
