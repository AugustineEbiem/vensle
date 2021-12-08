<?php

use Models\Functions;
$state = isset($_GET['state']) ? $_GET['state'] : "";
$out = include "src/Views/homenav.php";
$out .= "
<main class='main mb-10 pb-1'>
";
if(empty($errors) ) {
    $out .= "
    <div class='card-header card-top m-0 pt-1 pb-0'>
    <form action='' method='get'>
        <input type='hidden' name='keywords' value='{$_GET['keywords']}'>
        <input type='hidden' name='home_cat' value='";
        $out .= (isset($_GET['home_cat'])) ? $_GET['home_cat']:'';
        $out.= "'>
        <div class='row srhBxWrp'>
            <div class='col-md-1 pr-1 pl-1 m-0 srchBox' style='display:";
            if(!$is_admin){ 
                $out .= 'none'; 
            } 
                $out .= "'>
                <div class=' upPrYrs' >
                    <select name='country' class='form-control upPrSlct crs-country' data-region-id='two' id='country_select' >
                        <option value='{$country}'>{$code}</option>
                    </select>
                </div>
            </div>
            <div class='col-md-2 pr-1 pl-1 m-0 srchBox'>
                <div class='upPrYrs'>";

                    if($is_admin) {
                        $out .= "
                            <select class='form-control' name='state' id='one' style='width:200px'>
                                <option>Select State</option>
                            </select>";
                        
                    }else{
                        
                            $out .= "<select class='form-control' name='state' id='two'  style='width:200px' class='upPrSlct'></select>";
                        
                    }
                $out .= "</div>
            </div>
            <div class='col-md-2 pr-1 pl-1 m-0 srchBox'>
                <div class='upPrYrs category'>
                    <select class='form-control' name='item_group' id='srch_grp' class='upPrSlct'>
                        <option value=''>All Groups</option>
    
    ";
    foreach($all_groups as $groups){
        $out .= "<option ";
        $out .= ($item_group_id == $groups['id']) ? 'selected':'' ;
        $out .= "value='{$groups['id']}'> {$groups['name']} </option>";
    }
    $out .= "
    </select>
								
    </div>
</div>
<div class='col-md-2 pr-1 pl-1 m-0 srchBox'>
    <div class='upPrYrs'>
        <select class='form-control' name='group' id='srch_catgry' class='upPrSlct'>
            <option value=''>All Categories</option>
        </select>
    </div>
</div>
<div class='col-md-3 srchBox'>
    <div class='row upPrAdWrp form-group'>
        
        <div class='col-6 input-group p-0'>
          <span class='input-group-addon'>{$currency}</span>
          <input class='form-control input-default' type='number' value='{$min_price}' name='min_price' placeholder='Min Price' style='height: 44px;'>
        </div>
        
        <div class='col-6 input-group p-0'>
          <span class='input-group-addon'>{$currency} </span>
          <input class='form-control input-default' type='number' value='{$max_price}' name='max_price'  placeholder='Max Price' style='height: 44px;'>
        </div>
        
    </div>
</div>
<div class='col-md-1 pr-1 pl-1'>
			                <select class='sort form-control' name='sort' style='display: inline; width: 100%; margin-left: 5px;'>
                            <option value=''
    ";
    $out .= ($sort == '') ? 'selected':'' ;
    $out .= ">Sort by</option>
    <option value='asc' ";
    $out .= ($sort == 'asc') ? 'selected':'' ;
    $out .= ">Price - Lowest to Highest</option>
    <option value='desc' ";
    $out .= ($sort == 'desc') ? 'selected':'' ;
    $out .= ">Price - Highest to Lowest</option>
    </select>
</div>
<div class='col-md-1 text-center pt-1 '>
    <button type='submit' name='search_filter' class='btn btn-primary btn-md m-b-10 m-l-5  m-0'>Apply</button>
</div>
</div>  
</form>   
</div>";
}

$out .= "
<div class='row mr-2 ml-2' style='min-height: 500px;'>
		
		<section class='col-sm-12 card mb-1 mr-0 pr-0 ml-0 pl-0' id='drwinthrop'>
			<div class='card-body mb-0 pb-0'>
				<div class='row no-gutters'>
";
if(isset($_GET['keywords'])) {
    if(!isset($_GET['no_filter']) && empty($errors) && $feedback == '') {
        if(!isset($_GET['state']) && !isset($_GET['category']) && !isset($_GET['group']) && !isset($_GET['min_price']) && !isset($_GET['max_price']) && !isset($_GET['sort'])) {
            // echo 'nein';
            $errors['search_param'] = 'Invalid search parameter';
        }
    }

    if (empty($errors) && $feedback == '' ) {

        if(isset($_GET['no_filter'])) {
            $results = Functions::getSearchResults($keywords, $item_group_id, $home_cat);
        }
        
        $results_num = count($results);

        $suffix = ($results_num != 1) ? 's' : '';

        $out .= "<p class='col-12'>Showing Results for <strong>{$keywords}</strong> returned <strong>{$results_num}</strong> result{$suffix} in {$state}, {$country} </p>";
        $out .= "<div class='row cols-xl-5 cols-md-4 cols-sm-3 cols-2' >
       ";
        foreach($results as $result){

            //do the results hijacking here


            $out .= "	
            <div class='product-wrap'>
            <div class='product text-center'>
            <div class='product product-media py-4' data-target='#r{$result['id']}'>";
            if($result['item_condition'] == 1){
                $out .= "<span class='tip tip-new'>NEW</span>";
            }else{
                $out .= "<span class='tip tip-hot'>USED</span>";
            }
            $out .= "
            <img class='img-thumbnail' src='";
            $out .= (isset($result['image_id'])) ? Functions::getBackendAssetsLink().'/images/uploads/'. $result['id'] .'/'. $result['image_id'] .'.'.$result['ext']: Functions::getBackendAssetsLink().'/system/images/default.gif';
            $out .= "' style='max-height: 200px; min-height: 200px;' alt='{$result['title']}'>
            <div class='about text-center'>
            <h4 class='product-name'><a href='#r{$result['id']}' class='open-popup-link' >{$result['title']}</a>
            </h4>
            <span class='product-price'>{$currency}". number_format($result['price']) ."</span>
        </div>
        <a href='#r{$result['id']}' class='btn btn-primary text-uppercase open-popup-link' >
        Details
        </a>
						</div>
                        </div>
                        
                        <div  class='test mfp-hide  col-lg-4 col-md-6 col-sm-8' id='r{$result['id']}'>
                        <div class='modal-dialog mt-1'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <div class='swiper-container swiper-theme' data-swiper-options=\"{
                                        'spaceBetween': 10,
                                        'slidesPerView': 1,
                                        'breakpoints': {
                                            '992': {
                                                'slidesPerView': 1
                                            },
                                            '1200': {
                                                'slidesPerView': 1
                                            }
                                        }
                                    }\">
            
                                        <div class='swiper-wrapper'>
            ";
            $image_set = Functions::getProductImages($result['id']);
            $img_count = isset($image_set) ? count($image_set) : 0;
            $out .= "<div  style='width:250px !important;' class='swiper-slide' id='r{$result['id']}_slider' data-ride='carousel'>";
            // <ol class='carousel-indicators'>";
            // for($i=0; $i < $img_count; $i++){
            //     $out .= "<li data-target='#r{$result['id']}_slider' data-slide-to='{$i}'></li>";
            // }
            // $out .= " </ol>
            // <div class='carousel-inner'>";
            foreach($image_set as $image){
                // $out .= ($image['id'] == $result['display']) ? 'active':'';
                // $out .= "
                // '>
                $out .= "
                <img style='
                max-height: 100%;
                max-width: 100%;
                ' class='' src='".Functions::getBackendAssetsLink()."/images/uploads/{$result['id']}/{$image['id']}.{$image['ext']}' alt='{$result['title']}'>
                "; 
            }
            $out .= "</div>";
            if($img_count > 1) {
                $out .= "<div class='swiper-pagination'></div>";
            }
            $out .= "</div>   
            </div>
            <table class='table table-hover table-responsive'>
              <tbody>
                <tr>
                    <th scope='row'>ITEM</th>
                    <td>{$result['title']}
                    ";
            $out .= ($result['item_condition'] == 1) ? "<span class='badge badge-success'>NEW</span>" : "<span class='badge badge-primary'>USED</span>";
            $out .= "</td>
            </tr>
            <tr><th scope='row'>PRICE</th><td>{$currency}".number_format($result['price'], 2, '.', ',')."</td></tr>

            <tr><th scope='row'>SELLER</th><td>{$result['full_name']}</td></tr>
            <tr><th scope='row'>ADDRESS</th><td>{$result['item_address']}</td></tr>
            <tr><th scope='row'>MOBILE</th><td><a href='tel:{$result['item_contact_number']}'>{$result['item_contact_number']}</a></td></tr>
            </tbody>
        </table>
            
        <div class='modal-footer'>
            <a href='{$this->page->link}/single-item/{$result['id']}/huioh43940-80' class='btn btn-primary'>View More</a>
            <button type='button' onClick='closePopup();' class='btn btn-secondary' data-dismiss='modal'>Back</button>
        </div>

    </div>
</div>

</div>
</div>
</div>

        
        ";
								  


    }
    $out.= "</div>";
    }else{
        $out .= Functions::getFormErrors();
        $out .= ($feedback != '') ? $feedback : '';
    }
}
$out .= "
</div>
</div>
</div>
</div>
</div>
<!-- End of Product Wrapper 1 -->	

";
$out .= include "src/Views/homefooter.php";
$out .= "
</main>

";
$out .= "
<script type='text/javascript'>
    function func() {
        var1 = document.getElementById('uPrTxtbx');
        var2 = document.getElementById('price_status');
        if (var1.disabled && var2.disabled) {
            var1.disabled = false;
            var2.disabled = false;
        }
        else{
            var1.disabled = true;
            var2.disabled = true;
        }
       
    };

    function upload(){
        name = document.getElementById('item_name');
        desc = document.getElementById('desc');
        address = document.getElementById('item_addr');
        phone = document.getElementById('phne');

        if (name.value !='' && desc.value !='' && address.value!='' && phne.value !='') {
            document.getElementById('btn').disabled = false;
        }
    }
</script>
";
    $out .= "<script src='{$this->page->link}/vensle-assets/backend/js/country.js'></script>";
    // $out .= "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>";
//do the ajax functionality for this place
$out .= "<script type='text/javascript'>
$(document).ready(function() {
    $('#srch_grp').change(function() {
            console.log('data');
        var id = $(this).val();

        $.post('backend/ajax/async.php', {
            group_id: id
        }, function(data) {
            $('#srch_catgry').html(data);
        });
    });
});
</script>";


return $out;