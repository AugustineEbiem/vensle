<?php
use Models\Functions;
$out = "
<!-- Preloader - style you can find in spinners.css -->
    <div class='preloader'>
        <svg class='circular' viewBox='25 25 50 50'>
            <circle class='path' cx='50' cy='50' r='20' fill='none' stroke-width='2' stroke-miterlimit='10' /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id='main-wrapper'>
        <!-- Beginning of Admin header-->
        <div class='header'>
            <nav class='navbar top-navbar navbar-expand-md navbar-light'>
                <div class='navbar-header'>
                    <a class='navbar-brand' href='{$this->page->link}'>
                        <!-- Logo icon -->
                        <b><img src='{$this->page->link}/vensle-assets/backend/images/fav.gif' alt='homepage' class='dark-logo'></b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span style=''><img src='{$this->page->link}/vensle-assets/backend/images/logo4.png' alt='homepage' class='dark-logo'></span>
                    </a>
                </div>
                <div class='navbar-collapse'>
                    <ul class='navbar-nav mr-auto mt-md-0'>
                        <li class='nav-item'> <a class='nav-link nav-toggler hidden-md-up text-muted  ' href='javascript:void(0)'><i class='mdi mdi-menu'></i></a> </li>
                        <li class='nav-item m-l-10'> <a class='nav-link sidebartoggler hidden-sm-down text-muted SdbrbugMen ' href='javascript:void(0)'><i class='ti-menu'></i></a> </li>
                    </ul>
                    <ul class='navbar-nav my-lg-0'>
                        <li class='nav-item dropdown nvNotLst'>
                            <span class='flag-icon flag-icon-{$code} pt-5 mr-5'></span>
                        </li>
                        <li class='nav-item dropdown nvNotLst'>
                            <a class='nav-link dropdown-toggle text-muted text-muted nvNotLink ' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <i class='fa fa-bell'></i>
";
$all_notifications = Functions::getAllNotifications();
$returned_results = [];
foreach($all_notifications as $notification_array){
    if($notification_array['title'] == 'Product declined' && $notification_array['receiver_id'] != $_SESSION['user']['id']) {
        continue;
         }
         if($notification_array['title'] == 'Product declined' && $notification_array['viewed'] ==1) {
            continue;
        }
        if($notification_array['title'] == 'Request declined' && $notification_array['viewed'] ==1) {
            continue;
        }

        $returned_results[] = array(
                                'id' 				=> $notification_array['id'],
                                'request_id' 		=> $notification_array['request_id'],
                                'sender_id' 	    => $notification_array['sender_id'],
                                'receiver_id' 		=> $notification_array['receiver_id'],
                                'title' 			=> $notification_array['title'],
                                'sender_name' 		=> $notification_array['sender_name'],
                                'body' 			    => $notification_array['body'],
                                'viewed' 			=> $notification_array['viewed'],
                                'date_sent' 		=> $notification_array['date_sent']
        );
}
$request_count = count($returned_results);
if($request_count > 0) {
    $out .= "
        <div class='notify'>
        <span class='heartbit'></span> 
        <span class='point'></span> 
    </div>
    ";
}
$out .= "
</a>
<div class='dropdown-menu dropdown-menu-right mailbox animated zoomIn'>
    <ul>
        <li>
            <div class='drop-title'>Notifications</div>
        </li>
        <li>
            <div class='message-center'>
";
if($request_count > 0) {
    foreach($returned_results as $request) {
        if($request['title'] =='Request Sent') {
            $btn_color='info';
            $req_link = "{$this->page->link}/backend/my-requests/{$request['id']}";
        }elseif($request['title'] =='Product declined') {
            $btn_color='danger';
            $req_link = 'https://vensle.com/backend/edit-item/bibchen='. $request['request_id'] .'&eup=rsano3/listing/gs_l=16d'.'&noti='.$request['id'];
        }else {
            $btn_color='info';
            $req_link = "";
        }
        $out .= "
        <a href='{$req_link}'>
        <div class='btn btn-{$btn_color} btn-circle m-r-10'>
        ";
        if($request['title'] =='Request Sent'){
            $out .= "
                <i class='fa fa-bolt'></i>
            ";
        }elseif($request['title'] =='Product declined'){
            $out .= "
                <i class='fa fa-thumbs-down'></i>
            ";
        }
        $out .= "
        </div>
        <div class='mail-contnet'>
            <h5>{$request['title']}</h5> 
            <span class='mail-desc'>
                <b>
        ";
        if($request['title'] =='Request Sent' && $request['sender_id'] == $_SESSION['user']['id']) {
            $out .= "You";
        }else{
            $out .= $request['sender_name'];
        }
        $out.= " ".$request['body'];
        $out .= "
        </b>
        </span> 
        <span class='time'>{$request['date_sent']}</span>
        </div>
    </a>
        ";
    }
}
$out .= "
                                                
</div>
</li>
</ul>
</div>
</li>
<!-- End Comment -->
";
$out .= "
<!-- Messages -->
<li class='nav-item dropdown spcFrPflPc'>
";
$es = '';
$get_notifications = Functions::getNotificationMessages();
if($get_notifications){
    $notification_count = count($get_notifications);
}else{
    $notification_count = 0;
}
if($notification_count > 1){
    $es = 's';
}
$out .= "
<a class='nav-link dropdown-toggle text-muted  ' href='#' id='2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <i class='fa fa-envelope'></i>
";
if($notification_count > 0) {
    $out .= "
    <div class='notify msg_noti'> 
        <span class='heartbit'></span> <span class='point'></span> 
    </div>
    ";
}
$out .= "
</a>
<div class='dropdown-menu dropdown-menu-right mailbox animated zoomIn' aria-labelledby='2'>
    <ul>
        <li>
            <div class='drop-title'>";
                $out .= ($notification_count>0) ? 'You have '. $notification_count .' new message'.$es :'You have no new message';
            $out .= "</div>
        </li>
        
        <li class='msg_noti_cnt'>
            <div class='message-center'>
            <!-- Message -->
";
if($notification_count > 0) {
    foreach($get_notifications as $notification) {
        $out .= "
            <a class='nrdTrc unrdMsgWrp_51' href='{$this->page->link}/backend/read-message/?verste={$notification['request_id']}&bibchen_val=290_oi%90%'>
            <div class='user-img'> <!-- When the notification is clicked, collect its request id and send to read message.php -->
        ";
        if($notification['profile_img'] == '') {
            $out .= "
            <i class='fa fa-user-circle-o profile-pic prflPcImg'></i>
            ";
        }else{
            $out .= "<img src='{$this->page->link}/vensle-assets/backend/images/profile/{$noti['profile_img']} class='img-circle'>";
        }
        $out .= "
        <span class='profile-status busy pull-right'></span> 
        </div>
        <div class='mail-contnet'>
            <h5>{$notification['sender_name']}</h5> 
            <span class='mail-desc'>{$notification['body']}</span> 
            <span class='time'>{$notification['date_sent']}</span>
        </div>
    </a>
        
        ";
    }
}
$out .= "
                            
</div>
</li>
";
if($notification_count > 0) {
    $out .= "
        <li>
            <a class='nav-link text-center' id='clr_msg_noti' href='{$this->page->link}/backend/private/clear-msg'> <strong>Clear all message notifications</strong> </a>
        </li>
    ";
}
$out .= "
</ul>
</div>
</li>
<!-- End Messages -->
<!-- Profile -->
<li class='nav-item dropdown'>
    <a class='nav-link dropdown-toggle text-muted pflPcNav' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> 
";
if($_SESSION['user']['profile_img'] == '') {
    $out .= "<i class='fa fa-user-circle-o profile-pic prflPcImg'></i>";
}else{
    $out .= "<img class='profile-pic prflPcImg' src='{$this->page->link}/vensle-assets/backend/images/profile/{$_SESSION['user']['profile_img']}'>";
}
$out .= "
</a>
<div class='dropdown-menu dropdown-menu-right animated zoomIn'>
    <ul class='dropdown-user'>
        <li><a href='{$this->page->link}/backend/update-profile'><i class='ti-user'></i>Profile</a></li>
        <li><a href='{$this->page->link}/backend/'><i class='ti-wallet'></i> Go back to Website</a></li>
        <li><a href='{$this->page->link}/backend/message-inbox'><i class='ti-email'></i> Inbox</a></li>
        <li><a href='{$this->page->link}/backend/change-password'><i class='ti-settings'></i> Setting</a></li>
        <li><a href='{$this->page->link}/backend/logout'><i class='fa fa-power-off'></i> Logout</a></li>
    </ul>
</div>
</li>
<li class='nav-item dropdown'>
                            <p class='nav-link'>Welcome {$_SESSION['user']['full_name']}</p>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
";



return $out;
