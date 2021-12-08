<?php

use Models\Functions;

$out = "
<div class='container-fluid'>
            <!-- Start Page Content -->
            <div class='row'>
                    <div class='col-12'>
                        <div class='card'>
                            <div class='card-body'>
                                <div class='card-content'>
                                    <!-- Left sidebar -->

";
$out .= include('src/Views/dashboardmessageinboxsidebar.php');
$out .= "
<!-- End Left sidebar -->
<div class='inbox-rightbar'>

    <div class='m-t-10 m-b-20' role='toolbar'>
        <div class='btn-group'>
            <a class='btn btn-light waves-effect' href='{$this->page->link}/private/delete-message?bibchen_val={$read_msg['id']}&_oi%90%'><i class='mdi mdi-delete-variant font-18 vertical-middle'></i></a>
        </div>
        
    </div>
";
$out .= "
<div class='mt-4'>
    <h4>{$read_msg['subject']}</h4>

    <hr/>

    <div class='media mb-4 mt-1'>
";
if($read_msg['profile_img'] == '') {
    $out .= "<i style='font-size: 35px;' class='fa fa-user-circle-o profile-pic prflPcImg m-r-5'></i>";
}else{
    $out .= "<img class='d-flex mr-3 thumb-sm' src='".Functions::getBackendAssetsLink()."/images/profile/".$read_msg['profile_img']."' alt=''>";
}
$out .= " <div class='media-body'>
<span class='pull-right'></span>
<h6 class='m-0'>From: ";
if($read_msg['person'] != '') {
    $out .= $read_msg['person'];
}else {
    $out .= $read_msg['full_name'];
}
$out .= "
</h6>
<small class='text-muted'>{$read_msg['sent_date']}</small>
</div>
</div>
<p>{$read_msg['body']}</p>
<hr/>

";
if($read_msg['product_id'] !=0) {
    if($atched_prod = Functions::getProductDetailsById($read_msg['product_id'])) {
        $out .= "<div class='atcTtl'>
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
   
$out .= (isset($atched_prod['image_id'])) ? Functions::getBackendAssetsLink().'images/uploads/'. $atched_prod['product_id'] . '/' . $atched_prod['image_id'] .'.'.$atched_prod['ext']: Functions::getBackendAssetsLink().'images/default.gif';
$out .= "
'>
</div>

<div class='col-lg-6 dtls'>
<h3>{$atched_prod['title']}</h3>
<p class='state'>
";
$out .= $atched_prod['item_address'].', '.$atched_prod['state']; 
$out .= "</p>
<p class='ftrs'>
                                                                        
</p>
<div class='b'>
    <div><i class='fa fa-language e'></i></div>
    <div class='f'>Category: 
    <b>
";
$out .= $atched_prod['category_name'];
$out .= "</b></div>
</div>
<div class='b'>
<div><i class='fa fa-level-up e'></i></div>
<div class='f'>Condition: <b>
";
$out .= ($atched_prod['item_condition'] == 1) ? "<span class='badge badge-success'>NEW<span>": "<span class='badge badge-primary'>USED</span>" ; 
$out .= "</b><a class='text-primary' href='{$this->page->link}/single-item/{$atched_prod['product_id']}/huioh43940-80'> - View on Website</a> </div>
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
}
$out .= " </div>
<!-- card-box -->";
$out .= $errors;
$out .= "<form role='form' id='reply_form' ";
$out .= (!empty($errors)) ? "style='display: block;'":"style='display: none;'";
$out .= "action='' method='post'>
<div class='form-group'>
    <select name='sender_id' class='form-control input-default'>
    
<option value='{$read_msg['']}'>{$read_msg['other']}</option>
</select>
</div>
<div class='form-group'>
<input type='text' value='{$subject}' 
name='subject' class='form-control input-default' placeholder='Subject'>
</div>
<div class='form-group'>
    <textarea name='message' placeholder='Message' rows='8' cols='80' class='form-control input-default' style='height:160px'>{$message}</textarea>
</div>
<div class='form-group m-b-0'>
    <div class='text-right'>
        <button type='submit' name='msg_save' class='btn btn-success m-r-5'><i class='fa fa-floppy-o'></i></button>
        <button type='submit' name='msg_send' class='btn btn-purple'> <span>Send</span> <i class='fa fa-send m-l-10'></i> </button>
    </div>
</div>
</form>
    
    ";
    if (empty($errors) && $read_msg['person'] == '') {
        $out .= "<div class='text-right reply_btn'>
        <button type='button' class='btn btn-primary waves-effect waves-light w-md m-b-30'>Reply</button>
    </div>";

    }
    $out .= "
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- End PAge Content -->
</div>";
$footer_cust_lib = '
    ';
    $out .= include "src/Views/dashboardfooter.php";
    $out .= "<script type='text/javascript'>
    $('.reply_btn').click(function() {
        $('#reply_form').slideDown();
        $('.reply_btn').slideUp();
    });
</script>";


return $out;