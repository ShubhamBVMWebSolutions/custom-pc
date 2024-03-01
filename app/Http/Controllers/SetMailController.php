<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SiteMail;
use Illuminate\Support\Facades\Validator;
use Response;
use Carbon;

class SetMailController extends Controller
{

    function NewUserVerificationEmail($Maildata){
        $MailTo =  $Maildata['mailTo'];

        $data = [
                   'Subject'   => 'BVM - Account Verification Mail',
                   'message'   => 'Your account is created on BVM Web Solutions. Please click the below link to verify the account.',
                   'toUserName'=> $Maildata['toUserName'],
                   'name'=> $Maildata['name'],
                   'email'=>   $Maildata['email'],
                   'token'=> $Maildata['token'],
                   'MailBlade' => 'email.verification',
                 ];

       $mailResponse =  Mail::to($MailTo)->send(new SiteMail($data));

       return   $mailResponse;
    }

     function AdminNewOrderEmail($Maildata){
        $MailTo =  $Maildata['mailTo'];
        $order_id = $Maildata['order_id'];
        $orderData = getOrderById($order_id);
        $order_date = date('F j, Y', strtotime($orderData->created_at));

        $data = [
                   'Subject'   => 'You received a new order on SOI',
                   'message'   => $Maildata['message'],
                   'Name'=> $Maildata['Name'],
                   'email' => $Maildata['email'],
                   'address1' => $Maildata['address1'],
                   'address2' => $Maildata['address2'],
                   'city' => $Maildata['city'],
                   'state' => $Maildata['state'],
                   'country' => $Maildata['country'],
                   'zipcode' => $Maildata['zipcode'],
                   'phone' => $Maildata['phone'],
                   'order_id' => $order_id,
                   'MailBlade' => 'email.admin_new_order',
                 ];

       $mailResponse =  Mail::to($MailTo)->send(new SiteMail($data));

       return   $mailResponse;
    }

    function UserNewOrderEmail($Maildata){
        $MailTo =  $Maildata['mailTo'];
        $order_id = $Maildata['order_id'];
        $orderData = getOrderById($order_id);
        $order_date = date('F j, Y', strtotime($orderData->created_at));

        $data = [
                   'Subject'   => 'You received a new order on SOI',
                   'message'   => $Maildata['message'],
                   'Name'=> $Maildata['Name'],
                   'email' => $Maildata['email'],
                   'address1' => $Maildata['address1'],
                   'address2' => $Maildata['address2'],
                   'city' => $Maildata['city'],
                   'state' => $Maildata['state'],
                   'country' => $Maildata['country'],
                   'zipcode' => $Maildata['zipcode'],
                   'phone' => $Maildata['phone'],
                   'order_id' => $order_id,
                   'MailBlade' => 'email.new_order',
                 ];

       $mailResponse =  Mail::to($MailTo)->send(new SiteMail($data));

       return   $mailResponse;
    }

    function ContactRequestEmail($Maildata){
        $MailTo =  $Maildata['mailTo'];
        $data = [
                   'Subject'   => 'SOI Contact Request',
                   'message'   => $Maildata['message'],
                   'name'=> $Maildata['name'],
                   'email' => $Maildata['email'],
                   'phone' => $Maildata['phone'],
                   'MailBlade' => 'email.contact_request',
                 ];

       $mailResponse =  Mail::to($MailTo)->send(new SiteMail($data));

       return   $mailResponse;
    }


    function AdminNewFeedbackEmail($Maildata){
        $MailTo =  $Maildata['mailTo'];
        $data = [
                   'Subject'   => 'SOI - A New Feedback added',
                   'message'   => $Maildata['message'],
                   'name'=> $Maildata['name'],
                   'company_name' => $Maildata['company_name'],
                   'MailBlade' => 'email.admin_review_email',
                 ];

       $mailResponse =  Mail::to($MailTo)->send(new SiteMail($data));

       return   $mailResponse;
    }


    function MailUserUpdateByAdmin($Maildata)
    {
         $MailTo =  $Maildata['mailTo'];
         $data = [
                   'Subject'   => 'SOI account login information',
                   'message'   => 'Your account has been updated on SOI with following login information by Admin.',
                   'toUserName'=> $Maildata['toUserName'],
                   'toName'=>$Maildata['toName'],
                   'email'=> $Maildata['email'],
                   'password'=> $Maildata['password'],
                   'MailBlade' => 'email.admin_user_update',
                 ];

       $mailResponse =  Mail::to($MailTo)->send(new SiteMail($data));

       return   $mailResponse;
     }

     function MailUserCreatedByAdmin($Maildata)
    {
         $MailTo =  $Maildata['mailTo'];
         $data = [
                   'Subject'   => 'SOI account login information',
                   'message'   => 'Your account has been created on SOI by the Admin.',
                   'toUserName'=> $Maildata['toUserName'],
                   'toName'=>$Maildata['toName'],
                   'email'=> $Maildata['email'],
                   'password'=> $Maildata['password'],
                   'MailBlade' => 'email.admin_user_created',
                 ];

       $mailResponse =  Mail::to($MailTo)->send(new SiteMail($data));

       return   $mailResponse;
     }



    function sendGiftCardPinCode($giftcards)
     {

      $recipient_emailid = $giftcards['recipient_emailid'];
      $personal_message = $giftcards['personal_message'];
      $giftcard_number = $giftcards['giftcard_number'];
      $giftcard_pin = $giftcards['giftcard_pin'];
      $full_name = $giftcards['full_name'];
      $balance_amount = $giftcards['balance_amount'];


      $sender_full_name = $giftcards['sender_full_name']!=''?$giftcards['sender_full_name']:"";
      $sender_email = $giftcards['sender_email']!=''?$giftcards['sender_email']:"";

    if(isset($giftcards['sender_name']) && !empty($giftcards['sender_name'])){
      $sender_name =$giftcards['sender_name'];
    }else{
      $sender_name ='1';
    }

    // sendGiftCardPinCode



     Mail::send('email.user_giftcard_pincode', ['personal_message' => $personal_message,'full_name'=>$full_name,
     'giftcard_pin'=>$giftcard_pin,'giftcard_number'=>$giftcard_number,
     'sender_full_name' => $sender_full_name,'sender_email'=>$sender_email,'balance_amount'=>$balance_amount],
     function($message) use($recipient_emailid,$sender_email){
       $message->to([$recipient_emailid,$sender_email]);
       $message->subject('Gift Card Pin Code');
       // $message->subject($EmailContent->email_subject);
       // $message->attach(public_path('uploads/site-assets/videos/'.$video->content));
    });

}

}
