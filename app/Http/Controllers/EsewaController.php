<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require 'vendor/autoload.php';
use Cixware\Esewa\Client;
use Cixware\Esewa\Config;

class EsewaController extends Controller
{
    function payWithEsewa(){
        return view('esewa');
    }
    
    public function paymentFailure(Request $request){
        return view('esewa_failure');
    }
}
