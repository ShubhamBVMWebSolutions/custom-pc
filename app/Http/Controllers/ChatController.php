<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminModels\Admin;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Auth;


class ChatController extends Controller
{
    public function index($first_person_id,$second_person_id){
        // first person always will be admin 
        // second person always will be  client
        $first_person_id = base64_decode($first_person_id);
        $second_person_id = base64_decode($second_person_id);
        
        if(Auth::guard('admin')->check() && Auth::guard('web')->check()){
            abort(404);
        }
        
        if(Auth::guard('admin')->check())
        {
            $opened_by = $first_person_id;
            $sender_type = 'Admin';
        }else{
            $opened_by = $second_person_id;
            $sender_type = 'Client';
        }
        
        $first_person = Admin::where("id", $first_person_id)->first();
        
        if(empty($first_person)){
             abort(404);
        }
        
        $sender_id = $opened_by;

        if($opened_by == $first_person_id){
            $seen_by = "first_perosn";
            $receiver_id = $second_person_id;
        }else{
            $seen_by = "second_perosn";
            $receiver_id = $first_person_id;
        }
        
        if($sender_type == 'Admin'){
            $sender_details = $first_person;
            $receiver_details = User::where("id", $receiver_id)->first();
        }else{
            $sender_details = User::where("id", $receiver_id)->first();
            $receiver_details = $first_person;
        }
        
        $conversation_details = Conversation::where('first_person_id',$first_person_id)->where('second_person_id',$second_person_id)->first();
        if(empty($conversation_details)){
            $conversation_details = new Conversation();
            $conversation_details->first_person_id = $first_person_id;
            $conversation_details->second_person_id = $second_person_id;
            $conversation_details->save();
        }
        
        //update seen status
        if($seen_by == 'first_perosn'){
            Conversation::where("id",$conversation_details->id)->update(["first_person_seen"=>"Yes"]);
        }
        
        if($seen_by == 'second_perosn'){
            Conversation::where("id",$conversation_details->id)->update(["second_person_seen"=>"Yes"]);
        }
        
        Message::where("conversation_id",$conversation_details->id)->where("receiver_id",$opened_by)->update(["is_seen"=>"Yes"]);
        
        $tabtitle = "Message";
        $data = Message::where("conversation_id",$conversation_details->id)->orderBy("id","ASC")->get();
        return view('messages.index',compact('tabtitle','opened_by','sender_type','sender_id','receiver_id','sender_details','receiver_details','conversation_details','data'));
    }
    
    
    public function send_message(Request $request){
        $sender_type = base64_decode($request->sender_type);
        $sender_id = base64_decode($request->sender_id);
        $receiver_id = base64_decode($request->receiver_id);
        $conversation_id = base64_decode($request->conversation_id);
        if($sender_type == 'Admin'){
            $sender_details = Admin::where("id", $sender_id)->first();
            $receiver_details = User::where("id", $receiver_id)->first();
        }else{
            $sender_details = User::where("id", $sender_id)->first();
            $receiver_details = Admin::where("id", $receiver_id)->first();
        }
        
        $conversation_details = Conversation::find($conversation_id);
        if(empty($conversation_details)){
            abort(404);
        }
        
        $message = new Message();
        $message->conversation_id = $conversation_id;
        $message->text_type = $request->text_type;
        if($request->text_type == "text"){
            if(empty($request->message)){
                return response()->json(['status' =>"error",'title'=>"Error",'message' =>"Text required"]);
            }
            $message->message = $request->message;
        }else{
            if($request->hasFile('filemedia'))
            {
                $dir = public_path('/')."uploads/chats/";
                
    
                $image = time().'.'.$request->filemedia->getClientOriginalExtension();
                $uploadImg = $request->file('filemedia')->move($dir , $image);
                $message->message = $image;
            }else{
                return response()->json(['status' =>"error",'title'=>"Error",'message' =>"Image required"]);
            }
        }
        
        $message->sender_type = $sender_type;
        $message->sender_id = $sender_id;
        $message->receiver_id = $receiver_id;
        $is_save = $message->save();
        
        // sent transcript flag
        $conversation_details->is_transcript_sent = 0;
        if($conversation_details->first_person_id == $receiver_id){
            $conversation_details->first_person_seen = 'No';
        }
        
        if($conversation_details->second_person_id == $receiver_id){
            $conversation_details->second_person_seen = 'No';
        }
        
        $conversation_details->save();
        
        
        return response()->json(['status' =>"success",'title'=>"Success",'message' =>"submitted"]);
    }
    
    
    public function get_new_messages($conversation_id,$sender_id,$sender_type){
        $sender_id = base64_decode($sender_id);
        $conversation_id = base64_decode($conversation_id);
        $sender_type = base64_decode($sender_type);
        $messages = Message::where("conversation_id",$conversation_id)->get();
        
        $conversation_details = Conversation::where('id',$conversation_id)->first();
        if($conversation_details->first_person_id == $sender_id && $sender_type == 'Admin'){
            $reciver_type = 'Client';
            $seen_by = 'first_perosn';
            $sender_details =  Admin::where("id", $sender_id)->first();
            $receiver_details = User::where("id", $conversation_details->second_person_id)->first();
        }else{
            $reciver_type = 'Admin';
            $sender_details =  User::where("id", $sender_id)->first();
            $receiver_details = Admin::where("id", $conversation_details->first_person_id)->first();
            $seen_by = 'second_perosn';
        }
        
        
        //update seen status
        if($seen_by == 'first_perosn'){
            Conversation::where("id",$conversation_details->id)->update(["first_person_seen"=>"Yes"]);
        }
        
        if($seen_by == 'second_perosn'){
            Conversation::where("id",$conversation_details->id)->update(["second_person_seen"=>"Yes"]);
        }
        
        if(empty($sender_details)){
            $sender_name = "Guest";
        }else{
            $sender_name = $sender_details->name;
        }
        
        if(empty($receiver_details)){
            $receiver_name = "Guest";
        }else{
             $receiver_name = $receiver_details->name;
        }
        
        
        Message::where("conversation_id",$conversation_details->id)->where("receiver_id",$sender_id)->where("sender_type",$reciver_type)->update(["is_seen"=>"Yes"]);
        
        $output = '';
        if(!empty($messages)){
            foreach($messages as $row){
                if($row->is_seen == 'Yes'){
                        $text_color = "text-info";  
                    }else{
                        $text_color ="";
                }
                
                if($row->text_type == 'text'){
                    $messageText = $row->message;
                }else{
                    if(!empty($row->message)){
                            $dir = public_path('/')."uploads/chats/";
                            if (file_exists($dir . $row->message)) {
                                    $messageText ='<a href="'.asset('public/uploads/chats/'.$row->message).'" target="_blank"><img src="'.asset('public/uploads/chats/'.$row->message).'" alt="'.$row->message.'" style="width:100px;height:100px;"/></a>';
                            }else{
                                $messageText = $row->message;
                            }
                    }else{
                        $messageText = $row->message;
                    }
                }
                if($row->sender_id == $sender_id && $row->sender_type == $sender_type){
                     
                    $output .= '<li class="right clearfix">
                        <span class="chat-img pull-right">
                            <img src="https://via.placeholder.com/50/55C1E7/fff&text='.ucfirst(substr($sender_name, 0, 1)).'" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.date("d M Y h:i a",strtotime($row->created_at)).'</small>
                                <strong class="pull-right primary-font">'.$sender_name.'</strong>
                            </div>
                            <p>
                                '.$messageText.'
                            </p>
                            <small class="text-muted '.$text_color.'"><span class="glyphicon glyphicon-ok"></span></small>
                        </div>
                    </li>';
                }else{
                    $output .= '<li class="left clearfix">
                        <span class="chat-img pull-left">
                            <img src="https://via.placeholder.com/50/55AF55/fff&text='.ucfirst(substr($receiver_name, 0, 1)).'" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">'.$receiver_name.'</strong>
                                <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>'.date("d M Y h:i a",strtotime($row->created_at)).'</small>
                                
                            </div>
                            <p>
                                '.$messageText.'
                            </p>
                            <small class="text-muted '.$text_color.'"><span class="glyphicon glyphicon-ok"></span></small>
                        </div>
                    </li>';
                }
            }
        }
        
        return response()->json(["response"=>true,"htmldata"=>$output]);
    }
    
    public function get_new_message_status($conversation_id,$sender_id,$sender_type){
        $sender_id = base64_decode($sender_id);
        $conversation_id = base64_decode($conversation_id);
        $sender_type = base64_decode($sender_type);
        $message = Message::where("conversation_id",$conversation_id)->where("receiver_id",$person_email)->where("is_seen","No")->first();
        // dd($message);
        if(!empty($message)){
            return response()->json(["response"=>true]);
        }else{
            return response()->json(["response"=>false]);
        }
    }
}
