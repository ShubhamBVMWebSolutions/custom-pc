<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactRequest;

class ContactRequestController extends Controller
{
    function allrequests(){
        $requests = ContactRequest::orderBy('id','desc')->get();
        $data = compact('requests');
        return view('admin.manage_contact_list.all_requests',$data);
    }
    
    function viewRequest(Request $request,$encRequestId=null){
        $request_id = $encRequestId;
        $request_detail = ContactRequest::find($request_id);
        $data = compact('request_detail');
        return view('admin.manage_contact_list.view_request',$data);
    }
}
