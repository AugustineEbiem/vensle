<?php

use Models\Functions;

$out = "
<!-- Container fluid  -->
<div class='container-fluid uPrpWrp'>
    <!-- Start Page Content -->
";
$out .= Functions::getFormErrors();
$out .= "<form action='' method='post' enctype='multipart/form-data'>
<div class='row bg-white m-l-0 m-r-0 box-shadow pb-5'>
        <div class='col-md-6'>
            <ul class=' row list-group list-group-bordered' style='display:flex !important;flex-direction:row;'>";
$categories = Functions::getAllCategories();
foreach($categories as $cat_disp){
    $out .= "<li class='col-md-6 list-group-item";
    $out .= ($cat_disp['id'] == $cat_id) ? 'activated':'' ;
    $out .= "' style=''>
    <a href='?cat={$cat_disp['id']}' class='btn btn-info' style='width:100% !important;'>{$cat_disp['name']} </a>
    <!--<a class='minus' href=''><i class='fa fa-minus'></i></a>-->
    </li>
    ";
}
$out .= "</ul>
</div>
<div class='col-md-6'>
";
if(isset($cat_id)) {
    if (count($cat_set) > 0) {
        $cat_exist = true;
        $out .= "
        <div class='card pt-0'>
        <section class=' card mb-3 mr-0 pr-0 ml-0 pl-0 pt-0' id='drwinthrop'>
            <div class='card-body'>
                <div class='row no-gutters'>
                    <div class='col-6 col-sm-6'>
                        <div class='mov'>
        ";
        $out .= ($each_cat['image_1']) ? "<img class='img-thumbnail' src='".Functions::getBackendAssetsLink()."/images/display_category/{$each_cat['image_1']}' alt=''> <a href='?cat={$cat_id}&del_cat=image_1' class='flmov'><i class='fa fa-trash'></i></a>" : "<div class='no_img'></div>";
        $out .= "</div>
        <div class='mb-3' style='width: 88%;'>
            <div class='input-group'>
              <input class='form-control input-default' type='number' value='' name='Enter Amount' placeholder='Choose position*'>
            </div>
        </div>
        </div>
        <div class='col-6 col-sm-6'>
            <div class='mov'>";
            $out .= ($each_cat['image_2']) ? "<img class='img-thumbnail' src='".Functions::getBackendAssetsLink()."/images/display_category/{$each_cat['image_2']}' alt=''> <a href='?cat={$cat_id}&del_cat=image_2' class='flmov'><i class='fa fa-trash'></i></a>" : "<div class='no_img'></div>";
            $out .= " </div>
            <div class='mb-3' style='width: 88%;'>
                <div class='input-group'>
                   <input class='form-control input-default' type='number' value='' name='Enter Amount' placeholder='Choose position*'>
                </div>
            </div>
         </div>
         <div class='col-6 col-sm-6'>
             <div class='mov'>
             ";
             $out .= ($each_cat['image_3']) ? "<img class='img-thumbnail' src='".Functions::getBackendAssetsLink()."/images/display_category/{$each_cat['image_3']}' alt=''> <a href='?cat={$cat_id}&del_cat=image_3' class='flmov'><i class='fa fa-trash'></i></a>" : "<div class='no_img'></div>";
             $out .= " </div>
            <div class='mb-3' style='width: 88%;'>
                <div class='input-group'>
                   <input class='form-control input-default' type='number' value='' name='Enter Amount' placeholder='Choose position*'>
                </div>
            </div>
         </div>
         <div class='col-6 col-sm-6'>
             <div class='mov'>
             ";
             $out .= ($each_cat['image_4']) ? "<img class='img-thumbnail' src='".Functions::getBackendAssetsLink()."/images/display_category/{$each_cat['image_4']}' alt=''> <a href='?cat={$cat_id}&del_cat=image_4' class='flmov'><i class='fa fa-trash'></i></a>" : "<div class='no_img'></div>";
             $out .= " </div>
             <div class='mb-3' style='width: 88%;'>
                 <div class='input-group'>
                   <input class='form-control input-default' type='number' value='' name='Enter Amount' placeholder='Choose position*'>
                 </div>
             </div>
         </div>
     </div>
 </div>
</section>
</div>";

             
    }
}
$out .= " </div>
<div class='col-md-6'>
    <div class='card'>
        <div class='card-body'>
            <div class='basic-form'>
                <div class='row'>
                    <div class='form-group col-md-12 m-t-4'>
                        <div class=' upLtFlDv'>
                            <p>Drag & drop pictures here <br>or</p>
                            <input class='upLstFl dropzone p-t-145 p-b-85' type='file' name='files[]' multiple>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</div>";
if($cat_exist && ($each_cat['image_1'] == '' || $each_cat['image_2'] == '' || $each_cat['image_3'] == '' || $each_cat['image_4'] == '')) {
    $out .= "<div class='col-lg-12'>
    <div class='row'>
        <div class='col-md-6 text-center'>
            <button type='submit' name='add_cat_img' class='btn btn-primary btn-md m-b-10 m-l-5'>Update</button>
        </div>
    </div>
</div>";
}
$out .= " </div>
</form>


</div>";
$out .= include "src/Views/dashboardfooter.php";
return $out;