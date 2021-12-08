<?php

use Models\Functions;

$out = "
<!-- Messaging Sidebar -->
 <div class='container-fluid'>
    <div class='row'>
        <div class='col-12'>
            <div class='card p-t-5'>
                <div class='card-body'>
                    <div class='card-content'>
                                                                
                        <!-- <div class='inbox-leftbar'>
                            <a href='message_inbox.php' class='btn btn-danger btn-block'>Inbox</a>      
                            <div class='mail-list mt-4'>
                                <a class='list-group-item border-0 text-danger' href='{$this->page->link}/backend/message-inbox'>
                                <a class='list-group-item border-0 text-danger' href='message_inbox.php'><i class='mdi mdi-inbox font-18 align-middle mr-2'></i><b>Inbox</b><span class='label label-warning float-right ml-2 unrd_msg_cnt'>{$num_inbox}</span></a>
                                <a class='list-group-item border-0' href='#'><i class='mdi mdi-star font-18 align-middle mr-2'></i>Starred</a>
                                <a class='list-group-item border-0' href='".Functions::getPageUrl("/backend")."/message-draft'><i class='mdi mdi-file-document-box font-18 align-middle mr-2'></i>Draft<span class='label label-info float-right ml-2'>{$num_draft}</span></a>
                                <a class='list-group-item border-0' href='?sent_mail=true'><i class='mdi mdi-send font-18 align-middle mr-2'></i>Sent Mail</a>
                                <a class='list-group-item border-0' href='#'><i class='mdi mdi-delete font-18 align-middle mr-2'></i>Trash</a>
                            </div>
                        </div> -->
                        <div class='inbox-rightbar'>
                        <div class='mt-4'>
                        {$errors}

                        <form role='form' action='' method='post'>

                                    <div class='form-group'>


";
if($recv_id != '') {
    $user = Functions::getUserById($recv_id);
    $out .= "<input type='text' name='recvr' class='form-control form-control-alternative' value='{$user['full_name']}' disabled=''>";
}else{
    $out .= "<input type='text' name='recvr' placeholder='To' class='form-control input-default'>";
}
$out .= " </div>

<div class='form-group'>
    <input type='text' value='{$subject}' name='subject' class='form-control input-default' placeholder='Subject'>
</div>
<div class='form-group'>
    <textarea name='message' placeholder='Message' rows='8' cols='80' class='form-control input-default' style='height:160px'>{$message}</textarea>
</div>";
if($prod_id !=0) {
    $atched_prod = Functions::getProductDetailsById($prod_id);
    $out .= " <div class='atcTtl'>
    <h6> 
        <i class='fa fa-paperclip'></i>
        Attachments
        <span>(1)</span>
    </h6>
</div>

<div class='col-md-10 atchMal'>
    <div class='row bg-white m-b-8 read_msgs dshLstWrpRw'>";
    $out .= "<div class='col-lg-2 p-l-0 dshLstImgWp'>
    <img src='";
    $out .= (isset($atched_prod['image_id'])) ?  Functions::getBackendAssetsLink().'/images/uploads/'. $atched_prod['product_id'] . '/' . $atched_prod['image_id'] .'.'.$atched_prod['ext']: Functions::getBackendAssetsLink().'/images/default.gif';
    $out .= "'>
    </div>

<div class='col-lg-6 dtls'>
    <h3>{$atched_prod['title']}</h3>
    <p class='state'>{$atched_prod['item_address']},{$atched_prod['state']}</p>
    <p class='ftrs'>
        
    </p>
    <div class='b'>
        <div><i class='fa fa-language e'></i></div>
        <div class='f'>Category: <b>{$atched_prod['category_name']}</b></div>
    </div>
    <div class='b'>
    <div><i class='fa fa-level-up e'></i></div>
    <div class='f'>Condition: <b>
    ";
    $out .= ($atched_prod['item_condition'] == 1) ? "<span class='badge badge-success'>NEW<span>": "<span class='badge badge-primary'>USED</span>" ;
    $out .= "
    </b> </div>
    </div>
</div>
<div class='col-lg-4 prce'>
    <h3>{$currency}".number_format($atched_prod['price'], 2, '.', ',')."</h3>

    <section style='
        min-height: 10px;
        max-height: 80px;
        overflow-y: scroll;
    '>
        <div class='col-md-12'>
            <p>{$atched_prod['description']}</p>
            
        </div>
    </section>
    </div>
    </div>
</div>

    ";
}elseif($req_id !=0) {
    $atched_prod = Functions::getProductDetailsById($req_id);
$out .= "
<div class='atcTtl'>
<h6> 
    <i class='fa fa-paperclip'></i>
    Attachments
    <span>(1)</span>
</h6>
</div>

<div class='col-md-10 atchMal'>
<div class='row bg-white m-b-8 read_msgs dshLstWrpRw'>

        <div class='col-lg-2 p-l-0 dshLstImgWp'>
        <img src='
";
$out .= (isset($atched_prod['image_id'])) ?  Functions::getBackendAssetsLink().'/images/uploads/'. $atched_prod['product_id'] . '/' . $atched_prod['image_id'] .'.'.$atched_prod['ext']: Functions::getBackendAssetsLink().'/images/default.gif';
$out .= "
'>
</div>

<div class='col-lg-6 dtls'>
<h3>{$atched_prod['title']}</h3>
<p class='state'>{$atched_prod['item_address']},{$atched_prod['state']}</p>
<p class='ftrs'>
    
</p>
<div class='b'>
    <div><i class='fa fa-language e'></i></div>
    <div class='f'>Category: <b>{$atched_prod['category_name']}</b></div>
</div>

<div class='b'>
<div><i class='fa fa-level-up e'></i></div>
<div class='f'>Condition: <b>
";
$out .= ($atched_prod['item_condition'] == 1) ? "<span class='badge badge-success'>NEW<span>":"<span class='badge badge-primary'>USED</span>";
$out .= "
</b> </div>
</div>
</div>
<div class='col-lg-4 prce'>
<h3>{$currency}".number_format($atched_prod['price'], 2, '.', ',')."</h3>

<section style='
    min-height: 10px;
    max-height: 80px;
    overflow-y: scroll;
'>
    <div class='col-md-12'>
        <p>{$atched_prod['description']}</p>
        
    </div>
</section>



</div>
</div>
</div>
";
}

$out .= "<div class='form-group m-b-0'>
<div class='text-right'>
    <button type='submit' name='msg_save' class='btn btn-success m-r-5'><i class='fa fa-floppy-o'></i></button>
    <button type='submit' name='msg_send' class='btn btn-purple'> <span>Send</span> <i class='fa fa-send m-l-10'></i> </button>
</div>
</div>
</form>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>";
$out .= include "src/Views/dashboardfooter.php";
return $out;