<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogue;

class CatalogueController extends Controller
{
    public function index(){
        $data=[];
        $data['catalogues'] = Catalogue::where("status","Publish")->get();
        return view('catalogue_index',$data);
    }
    
    public function single($id){
        $data=[];
        $id = base64_decode($id);
        $data['catalogue'] = Catalogue::where("status","Publish")->where("id", $id)->first();
        if(empty($data['catalogue'])){
            return abort('404');
        }
        return view('catalogue_single',$data);
    }
}
