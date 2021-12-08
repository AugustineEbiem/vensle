<?php

use Models\Functions;
use Models\Messages;

$out = "<div class='container-fluid uPrpWrp'>
<div class='row'>
    <div class='col-12'>
        <div class='card'>
            <div class='card-body'>
                <div class='card-content'>
                    <!-- Left sidebar -->";
                    $out .= include('src/Views/dashboardmessageinboxsidebar.php');
                    $out .= "<!-- End Left sidebar -->
                    <div class='inbox-rightbar'>
                        <div role='toolbar' class=''>
                            <div class='btn-group'>
                                <button class='btn btn-light waves-effect' type='button'><i class='mdi mdi-archive font-18 vertical-middle'></i></button>
                                <button class='btn btn-light waves-effect' type='button'><i class='mdi mdi-alert-octagon font-18 vertical-middle'></i></button>
                                <button class='btn btn-light waves-effect' type='button'><i class='fa fa-trash-o font-18 vertical-middle'></i></button>
                            </div>
                        </div>
                        <div class=''>
                            <div class='mt-4'>
                                <div class=''>
                                    <ul class='message-list'>";
$messages = Messages::getMyMessages("sent");
if($messages){
    $number_of_messages = count($messages);
}else{
    $number_of_messages = 0;
}
if($number_of_messages > 0){
    foreach($messages as $message){
        $out .= "
        <li class='";
        $out .= ($message['msg_read'] == 0) ? 'unread':'';
        $out .= "'>
        <a href='{$this->page->link}/backend/read-message?verste={$message['id']}&bibchen_val=290_oi%90%'>
        <div class='col-mail col-mail-1'>

            <div class='checkbox-wrapper-mail'>

                <input type='checkbox' id='chk{$message['id']}'>

                <label class='toggle' for='chk{$message['id']}'></label>

            </div>

            <p class='title'>
        ";
        $out .= $message['person'] != '' ?  $message['person'] : $message['full_name'];
        $out .= "</p>";
        if($message['product_id']){
            $out .= "<span class='star-toggle fa fa-paperclip'></span>";
        }else{
            $out .= "<span style='visibility: hidden;' class='star-toggle fa fa-star-o'></span>";
        }
        $out .= "
        </div>
        <div class='col-mail col-mail-2'>
            <div class='subject'>
        ";
        $out .= $message['reply_id'] !=0 ? "Re:" : "";
        $out .= "{$message['subject']}
        &nbsp;&ndash;&nbsp;

        <span class='teaser'>{$message['body']}</span>

    </div>

    <div class='date'>".date('d-m-Y', strtotime($message['sent_date']))."</div>

</div>

</a>

</li>
        ";
       
    }
   
}else{
    $out .= "You do not have any message";
}
$out .= "
</ul>
</div>
</div>
<!-- panel body -->
</div>

<!-- panel -->
<div class='row'>
<div class='col-7'>
Showing 1 - 20 of 2
</div>
<div class='col-5'>
<div class='btn-group float-right'>
<button class='btn btn-gradient waves-effect' type='button'><i class='fa fa-chevron-left'></i></button>
<button class='btn btn-gradient waves-effect' type='button'><i class='fa fa-chevron-right'></i></button>
</div>
</div>
</div>
</div>
<div class='clearfix'></div>



</div>

</div>

</div>

</div>

</div>
</div>
</div>";
$out .= include "src/Views/dashboardfooter.php";

return $out;