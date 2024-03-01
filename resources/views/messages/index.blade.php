<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>@yield('title') - {{ SiteSettingByName('site_name') }}</title>
    <style>
    body{
        background: #dfe8eb;
    }
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }
        
        .chat li.left .chat-body {
            margin-left: 60px;
        }
        
        .chat li.right .chat-body {
            margin-right: 60px;
        }
        
        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }
        
        .panel .slidedown .glyphicon,
        .chat .glyphicon {
            margin-right: 5px;
        }
        .panel-heading .btn-group .btn {
            background-color: transparent;
            border: none;
            color: #fff;
            line-height: 22px;
        }
        .panel-heading .btn-group .btn:focus {
             border: none;
             outline: none;
             box-shadow: none;
             background-color: transparent;
             color: #fff;
        }
        .panel-heading .chat-ico .glyphicon {
            margin-top: 3px;
        }
        .panel-body {
            overflow-y: auto;
            height: calc(100vh - 199px);
        }
        /*.panel-footer .form-group form {*/
        /*    display: flex;*/
        /*    align-items: center;*/
        /*}*/
        
         ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }
        
         ::-webkit-scrollbar {
            width: 5px;
            background-color: #F5F5F5;
        }
        
         ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 2px rgba(0, 0, 0, .3);
            background-color: #ccc;
        }
        .panel-heading {
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            column-gap: 10px;
        }
        .panel-heading .chat-ico {
            font-size: 18px;
            display: flex;
            column-gap: 10px;
        }
        .panel-footer .form-group form .form-control {
            max-height: 50px;
        }
        .panel-footer .form-group form button.btn {
            min-width: 70px;
            font-size: 15px;
            margin-left: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }
        #img_url {
          background: #ddd;
          width:100px;
          height: 90px;
          display: block;
        }
        .panel-primary>.panel-heading {
            color: #fff;
            background-color: #0156cb;
            border-color: #0156cb;
        }
        .btn-primary {
            color: #fff;
            background-color: #0156cb;
            border-color: #0156cb;
        }
        .d-block {
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin: 30px 0 10px;">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="chat-ico"><span class="glyphicon glyphicon-comment"></span> Chat ({{ strtotime($conversation_details->created_at) }})</div> 
                        
                        <div class="btn-group pull-right">
                            
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </button>
                            <ul class="dropdown-menu slidedown">
                                <li><a href="javascript:void(0);" onclick="window.location.reload(); "><span class="glyphicon glyphicon-refresh">
                                </span>Refresh</a></li>
                                <!--<li class="divider"></li>-->
                                <!--<li><a href="javascript:void(0)" onclick="window.close();"><span class="glyphicon glyphicon-off"></span>-->
                                <!--    Close tab</a></li>-->
                            </ul>
                            &nbsp;
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul class="chat" id="chatMessageUlDIv">
                            
                        </ul>
                        
                    </div>
                    <div class="panel-footer">
                        <img src="" id="img_url" alt="your image"style="display:none">
                        <div class="form-group">
                            <form id ="chatForm" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="sender_id" value="{{base64_encode($sender_id)}}"/>
                                <input type="hidden" name="sender_type" value="{{base64_encode($sender_type)}}"/>
                                <input type="hidden" name="receiver_id" value="{{base64_encode($receiver_id)}}"/>
                                <input type="hidden" name="conversation_id" value="{{base64_encode($conversation_details->id)}}"/>
                                <div class="d-block">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="text_type" id="radioForText" value="text" checked onchange="display()">
                                  <label class="form-check-label" for="exampleRadios1">
                                    Text
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="text_type" id="radioForImage" value="image" onchange="display()">
                                  <label class="form-check-label" for="exampleRadios2">
                                    Image
                                  </label>
                                </div>
                                </div>
                                <div class="d-block">
                                <input id="chatInput" type="text" class="form-control" name="message" placeholder="Type your message here..." style="display:none"/>
                                <input id="chatFile" type="file" class="form-control" name="filemedia" style="display:none" onChange="img_pathUrl(this);"/>
                                
                                <!-- <input id="btn-input" type="text" class="form-control input-sm" name="message" placeholder="Type your message here..." required/> -->
                                <!-- <span class="input-group-btn"> -->
                                <button class="btn btn-primary" type="submit" id="btn-chat">Send</button>
                                </div>
                                <!-- </span> -->
                            </form>
                        </div>
                    </div>
                    <div id="panelBodyBottom">
                            
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->
    
    <script>
    
    $(document).ready(function() { 
      display();  
    });
    function display() {
    if(document.getElementById('radioForText').checked) {
            // alert(document.getElementById("radioForText").value+ " radio button checked");
            $("#chatInput").show();
            $("#chatFile").hide();
            $("#img_url").hide();
            
        }else if(document.getElementById('radioForImage').checked) {
            $("#chatInput").hide();
            $("#chatFile").show();
            
        }else {
            document.getElementById("disp").innerHTML= "No one selected";
        }
    }
    
    function img_pathUrl(input){
            $("#img_url").show();
            $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    }
    </script>
    
    <script>
    $(document).ready(function() { document.getElementById( 'panelBodyBottom' ).scrollIntoView({behavior: "smooth"});});
    
    function updateScreen(){
        var submitUrl = '{{route("messages.get-new-messages", [base64_encode($conversation_details->id),base64_encode($sender_id),base64_encode($sender_type)])}}';
        $.get(submitUrl, function(data, status){
            console.log(data.response);
            if(data.response == false){
                $("#alertRed").html('');
            }else{
                $("#chatMessageUlDIv").html(data.htmldata);
            }
      });
    }
    
    setInterval(function(){ 
        updateScreen()
    }, 1000);
    
    
    //form submit
    
    $("#chatForm").submit(function(event) {
            event.preventDefault();
            // alert("test");
            var submitUrl = '{{route('messages.send-message')}}';
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            $.ajax({
                url: submitUrl,
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                async: false,
                success: function(response) {
                    if (response.status == 'success') {
                        
                        
                        document.getElementById("radioForText").checked = true;
                        $("#chatInput").val('');
                        $("#chatInput").show();
                        $("#chatFile").hide();
                        $("#img_url").hide();
                    }
        
                    if (response.status == 404) {
                    
                    }
                    if (response.status == 'error') {
                        alert(response.message);
                    }
                },
            });
        });
    </script>
</body>

</html>