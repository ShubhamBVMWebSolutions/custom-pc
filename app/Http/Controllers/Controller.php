<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Mail\SiteMail;
use App\Http\Controllers\SetMailController;
use App\Models\ProductCollection;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    public function test_code(){
        // $Maildata = array(
        //                     'mailTo'=>'surendra.bvmsolutions@gmail.com',
        //                     'toUserName'=>'Surendra',
        //                     'name' => 'surendra',
        //                     'email'=>'surendra.bvmsolutions@gmail.com',
        //                     'token'=> '65474139676541654',
        //     );
        //     $Mailcontroller = new SetMailController();
        //     $Mailcontroller->NewUserVerificationEmail($Maildata);
        
        $productCollectionMenu = ProductCollection::where('parent_id',null)->where('list_in_product_menu','Yes')->get();
        $result = treeMenuFromProductCollection($productCollectionMenu);
        print_r($result);die;
    }
}
