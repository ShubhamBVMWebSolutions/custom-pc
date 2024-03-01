<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSlider;
use App\Models\HomeLogosSlider;
use App\Models\Testimonials; 
use App\Models\GettingStarted;
use App\Models\Product;
use App\Models\OrderItems;
use Session;
use Config;
use Str;

class HomeController extends Controller
{
    public function index()
    { 
        $homeslider = HomeSlider::where('status','=',1)->orderBy('id','DESC')->get();
        $homelogos = HomeLogosSlider::where('status','=',1)->orderBy('id','DESC')->get();
        $testimonials = Testimonials::where('status','=',1)->orderBy('id','DESC')->limit(3)->get();
        $gettingsdata = GettingStarted::where('status','=',1)->orderBy('id','ASC')->get();
        $featured_products = Product::where([
            ['featured','yes'],
            ['status',1]
            ])->orderBy('id','DESC')->paginate(6);
            
        $selling_products = OrderItems::select('product_id')
    ->groupBy('product_id')
    ->orderByRaw('COUNT(*) DESC')
    ->get();
    //print_r($selling_products);
        $data = compact('homeslider','homelogos','testimonials','gettingsdata','featured_products','selling_products');
        return view('home',$data);
    }
    
    function submitReview(Request $request){
        if($request->ajax())
        {
            $name = $request->name;
            $company_name = $request->company_name;
            $review = $request->review;
            $image = '';
            
            $saveTestomonial = new Testimonials;
            
            if(isset($request->image)){
                $image = $request->image->getClientOriginalName();
                $dir = public_path('/').Config::get('constants.TESTIMONIAL_IMAGE_PATHS');
                $uploadImg = $request->file('image')->move($dir , $image);
            }
            
            $saveTestomonial->name = $name;
            $saveTestomonial->company = $company_name;
            $saveTestomonial->content = $review;
            $saveTestomonial->image = $image;
            $saveTestomonial->status = 0;
            $isSaved = $saveTestomonial->save();
            
            if($isSaved){
                //$MailToAdmin =  SiteSettingByName('site_email');
                $MailToAdmin = 'preeti.bvmsolution@gmail.com';
                $Maildata = array(
                            'mailTo'=>$MailToAdmin,
                            'name'=>$name,
                            'company_name' => $company_name,
                            'message'=>$review,
                            );
            $Mailcontroller = new SetMailController();
            ///////////////////////////////////////////////////////
            // $Mailcontroller->AdminNewFeedbackEmail($Maildata);
            //////////////////////////////////////////////////
                $collectArray = array(
                               'status'=>'success', 
                             );
            }
            else{
               $collectArray = array(
                               'status'=>'failed', 
                             ); 
            }
            
            return json_encode($collectArray);
        }
    }
}
