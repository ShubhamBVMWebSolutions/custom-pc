<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductRating;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = ProductRating::orderBy('id','Desc')->get();
    	$data = compact('reviews');
        return view('admin.reviews.index',$data);
    }

    public function destroy(Request $request)
    {
        $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = ProductRating::find($idFor);
            $ResponseStatus =  $IsExists_info->delete();
        }
        $collectArray = array('status'=>$ResponseStatus);
        return json_encode($collectArray);
    }

    public function update_status($id, $status){

        ProductRating::where("id",$id)->update(["status"=>$status]);

        session()->flash("alert-success","Review status updated successfully.");

        return redirect()->back();
    }
}
