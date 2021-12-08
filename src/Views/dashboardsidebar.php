<?php
$out = "
<!-- Beginning of Left sidebar -->
<div class='left-sidebar'>
            <!-- Sidebar scroll-->
            <div class='scroll-sidebar'>
                <!-- Sidebar navigation-->
                <nav class='sidebar-nav'>
                    <ul id='sidebarnav'>
                          
                        <li class='nav-devider'></li>   
                        <li class='nav-label'>{$country} <span class='flag-icon flag-icon-{$code} pull-right'></span></li>
                        <li> 
                        <a class=' ' href='{$this->page->link}/backend' aria-expanded='false'><i class='fa fa-tachometer'></i>
                        <span class='hide-menu'>Dashboard </span> </a> 
                    </li>
                    <li> 
                        <a class='has-arrow  ' href='#' aria-expanded='false'><i class='fa fa-wpforms'></i>
                            <span class='hide-menu'>
                                Products

";
$atn_count = $request_count;
if(isset($no_apprv) && $no_apprv > 0) {
    $atn_count = $request_count1 + $no_apprv;
    $numm = $request_count1 + $n2;
}
$out .= ($atn_count >0) ? "<span class='label label-rouded label-warning pull-right'>{$numm}</span>" : "";
$out .= "
</span>
</a>

<ul aria-expanded='false' class='collapse'>
    <li><a href='{$this->page->link}/backend/upload-item'>Upload New Item</a></li>
    <li><a href='{$this->page->link}/backend/my-products'>My Products
";
if($n2 != 0){
    $out .= "<span class='label label rounded label-warning pull-right'>{$n2}</span>";
}
$out .= "</a></li>";
if($is_admin) {
    $out .= " <li><a href='{$this->page->link}/backend/all-products'>All Products</a></li>
    <li><a href='{$this->page->link}/backend/approve-product'>Pending Products";
    if(isset($n2) && $n2 > 0) {
        $out .= "<span class='label label-rounded label-warning'>{$n2}</span>";
    }
}
$out .= "<li><a href='{$this->page->link}/backend/sold-items'>Sold Item</a></li>";
if($is_admin){
    $out .= "<li><a href='{$this->page->link}/backend/category-display'>Category Display</a></li>
    <li><a href='{$this->page->link}/backend/featured-products'>Featured Products</a></li>";
}
$out .= "<li><a href='{$this->page->link}/backend/place-request'>Place a Request</a></li>";
$out.= "<li><a href='{$this->page->link}/backend/my-requests'>My Requests";
$out.= ($request_count1 > 0 ) ? "<span class='label label-rounded label-warning'>{$request_count1}'</span>" : "";$out .= "</a></li>";
if($is_admin){
    $out.= "<li><a href='{$this->page->link}/backend/all-requests'>All Requests</a></li>
    <li><a href='{$this->page->link}/backend/approve-request'>Pending Requests";
    if(isset($n1) && $n1 > 0) {
        $out .= "<span class='label label-rounded label-warning'>{$n1}</span>";
    }
    $out.= " </a></li>";
}
$out .= "<li><a href='{$this->page->link}/backend/bought-items'>Bought Items</a></li>
</ul>
</li>";
if($is_admin){
    $out .= "<li> 
    <a href='{$this->page->link}/backend/users' aria-expanded='false'>
        <i class='fa fa-group'></i>
        <span class='hide-menu'>Users</span>
    </a>
</li>";
}
$out .= "<li> 
<a class='has-arrow' href='#' aria-expanded='false'>
    <i class='fa fa-cog'></i>
    <span class='hide-menu'>Settings</span>
</a>
<ul aria-expanded='false' class='collapse'>
    <li><a href='{$this->page->link}/backend/update-profile'>Update Profile</a></li>
    <li><a href='{$this->page->link}/backend/change-password'>Change password</a></li>
</ul>
</li>
<li>
<a class='has-arrow ' href='#' aria-expanded='false'>
<i class='fa fa-comments-o'></i>
<span class='hide-menu'>Message</span> ";
if(isset($noti_count) && $noti_count > 0) {
    $out .= "<span class='label label-rouded label-success pull-right'>{$noti_count}</span>";
}
$out .= "    
</a>
<ul aria-expanded='false' class='collapse'>
    <li><a href='{$this->page->link}/backend/message-compose'>Compose</a></li>
    <li>
        <a href='{$this->page->link}/backend/message-inbox'>All";

if(isset($noti_count) && $noti_count > 0) {
    $out .= "<span class='label label-rouded label-success pull-right'>{$noti_count}</span>";
}
$out .= "</a>
</li>
<li><a href='{$this->page->link}/backend/message-sent'>Sent Messages</a></li>
<li><a href='{$this->page->link}/backend/message-draft'>Drafts</a></li>
</ul>                            
</li>
</ul>
</nav>
<!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</div>
<!-- End of LeftSidebar -->";

$out .= "<!--  -->
<div class='page-wrapper LstdshWrp'>
    <!-- Bread crumb -->
    <div class='row page-titles m-b-20'>
        <div class='col-md-5 align-self-center'>
            <h3 class='text-primary'>";
$out .= (isset($crumbs)) ? $crumbs : ''; 
$out .= $bread;  
$out .= "</h3>";
if(isset($menu_btns)) { 
    $out .= "<div class='btn-group' style='position: absolute;top: 0;right: 0;'>
                            

    <div class='message-list'>
        <!-- <li class='unread'> -->
            <div class='checkbox-wrapper-mail'>
              <input type='checkbox' class='aprv_chk' id='checkAll'>
              <label class='toggle' for='checkAll'></label>
            </div>
        <!-- </li> -->
    </div>

    <button class='btn btn-light' id='apv_sltd' type='button'>
        <i class='fa fa-eye font-18 vertical-middle'></i>
    </button>

</div>";
}
$out .= " </div>
<div class='col-md-7 align-self-center'>
    <ol class='breadcrumb'>
        <li class='breadcrumb-item'><a href='javascript:void(0)'>Home</a></li>
        <li class='breadcrumb-item active'>{$bread}</li>
    </ol>
</div>


<br />
</div>
<!-- End Bread crumb -->";

$out .= "
<!-- Container fluid  -->
<div class='container-fluid'>
                <!-- Start Page Content -->
";






return $out;