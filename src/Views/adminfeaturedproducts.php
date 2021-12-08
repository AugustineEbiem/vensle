<?php

use Models\Functions;
use Models\Products;

$out = "";
$out .= Functions::getFormErrors();
$out .= "
    
    <div class='row bg-white m-l-0 m-r-0 box-shadow pb-5'>
        <div class='col-md-12'>
            <ul class=' row list-group list-group-bordered' style='display:flex !important;flex-direction:row;'>";
                $categories = Functions::getAllCategories();
                foreach($categories as $cat_disp){
                    $out .= "<li class='col-md-6 list-group-item";
                    $out .= ($cat_disp['cat_id'] == $cat_id) ? 'active':'' ;
                    $out .= "' style=''>
                    <a href='?cat={$cat_disp['cat_id']}' class='btn btn-info' style='width:100% !important;'>{$cat_disp['name']} </a>
                    <!--<a class='minus' href=''><i class='fa fa-minus'></i></a>-->
                    </li>
                    ";
                }
                $out .= "
            </ul>
        </div>
    </div>
<!-- Start Page Content -->
    <div class='row'>
        <div class='col-lg-12'>
            <div class='card p-t-0'>
                <div class='card-body'>
                    <h2>Featured Products</h2>
                    <div class='table-responsive'>
                        <table id='myTable' class='table table-bordered table-hover table-striped'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Item</th>
                                    <th>Country</th>
                                    <th>Position</th>
                                    <th>Ref. No</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>";
                            if ($cat_id != null) {
                                $products = Products::getGroupsCategories('item_group',$cat_id,true,'no');
                                $count = count($products);
                                if($count > 0){
                                    $count = 1;
                                    foreach($products as $product){
                                        $out .= "
                                        <tr>
                                        <td>{$count}</td>
                                        <td>
                                            <div class='rect-img'>
                                                <a href='#'><img src='
                                        ";
                                        $out .= (isset($product['image_id'])) ? Functions::getBackendAssetsLink().'/images/uploads/'. $product['id'] .'/thumb_'. $product['image_id'] .'.'.$product['ext']: Functions::getBackendAssetsLink().'/images/default.gif';
                                        $out .= "
                                        '>";
                                        $out .=  ($product['item_condition'] == 1) ? "<span class='badge badge-success'>NEW<span>" : "<span class='badge badge-primary'>USED</span>" ;
                                        $out .= "
                                        </a>
                                        </div>
                                        </td>
                                        <td><span><a href='#' data-toggle='modal' data-target='#r{$product['id']}'>{$product['title']}</a></span></td>
                                        <td><span>{$product['country']}</span></td>
                                        <td><span>{$product['position']}</span></td>
                                        <td>
                                            {$product['ref_no']}
                                        </td>
                                        <td><span>". date('d-m-Y', strtotime($product['upload_date']))."</span></td>
                                        <td><span><a class='btn btn-info' data-toggle='modal' data-target='#r{$product['id']}featured' ><i class='fa fa-edit'></i>Set Position</a><button class='btn btn-danger'><i class='fa fa-trash'></i></button></span></td>
                                        </tr>
                                        <div class='modal fade' id='r{$product['id']}featured'>
                                            <div class='modal-dialog mt-1'>
                                                <div class='modal-content'>
                                                    <div class='example-wrap mb-0'>
                                                        <div class='row justify-content-center pb-2' style='z-index: 2; position: relative;'>
                                                        
                                                            <div class='col-lg-12'>
                                                                <div class='text-muted text-center mb-3'>
                                                                    <h3 class=''><small>Select Featured Position for this Product</small></h3>
                                                                </div>
                                                            </div>
                                                            <div class='form-group'>
                                                                <p>Product name: <b>{$product['title']}</b></p>
                                                                
                                                            </div>
                                                            <div class='px-lg-5 py-lg-5 col-lg-12'>
                                                                <form action='{$this->page->link}/private/position-featured' method='POST' >
                                                                <label>Enter Product Position</label>
                                                                    <input type='number' class='form-control' value=''  name='position' min='1' max='12' placeholder='Enter Position'  required/>
                                                                    <input type='hidden' value='{$product['id']}' name='product_id'>
                                                                    <div class='text-center'>
                                                                        <button type='submit'   name='submit' class='btn btn-success my-4'>Set Position</button>
                                                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Back</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='modal fade' id='r{$product['id']}'>
                                            <div class='modal-dialog mt-1'>
                                                <div class='modal-content'>
                                                    <div class='modal-body'>";
                                                        $image_set = Functions::getProductImages($product['id']);
                                                        if($image_set){
                                                            $img_count = count($image_set);
                                                        }else{
                                                            $img_count = 0;
                                                        } 
                                                        $out .= "
                                                        <div class='carousel slide carousel-fade ml-5 mr-5 pl-5 pr-5' id='r{$product['id']}_slider' data-ride='carousel'>
                                                            <ol class='carousel-indicators'>";
                                                                for ($i=0; $i < $img_count; $i++) { 
                                                                    $out .= "
                                                                <li data-target='#{$product['id']}_slider' data-slide-to='{$i}'></li>";
                                                                    }
                                                                    $out .= "
                                                            </ol>
                                                            <div class='carousel-inner'>";
                                                                if($img_count > 0){
                                                                    foreach($image_set as $image){
                                                                        $out .= "
                                                                    <div class='carousel-item "; $out .= ($image['id'] == $product['display']) ? 'active':'' ; $out .= "'>
                                                                        <img class='d-block w-100' src='".Functions::getBackendAssetsLink()."/images/uploads/{$product['id']}/thumb_{$image['id']}.{$image['ext']}' alt='{$product['title']}' />
                                                                    </div>";
                                                                    }
                                                                }
                                                                $out .= " 
                                                            </div>
                                                            <a class='carousel-control-prev' href='#r{$product['id']}_slider' role='button' data-slide='prev'>
                                                                   <span class='carousel-control-prev-icon' aria-hidden='true'>
                                                                    <span class='sr-only'>Previous</span>
                                                                </span>
                                                            </a>
                                                            <a class='carousel-control-next' href='#r{$product['id']}_slider'
                                                            role='button' data-slide='next'>
                                                                <span class='carousel-control-next-icon' aria-hidden='true'>
                                                                    <span class='sr-only'>Next</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class='row' style='padding:20px'>
                                                            <div class='col-md-4'><b>TITLE</b>
                                                            </div>
                                                            <div class='col-md-8'>{$product['title']} ";
                                                                    $out .= ($product['item_condition'] == 1) ? "<span class='badge badge-success'>NEW</span>":"<span class='badge badge-primary'>USED</span>";
                                                                    $out .= "
                                                            </div>
                                                        </div>
                                                        <div class='row' style='padding:20px'>
                                                            <div class='col-md-4'><b>PRICE</b>
                                                            </div>
                                                            <div class='col-md-8'>{$currency}".number_format($product['price'], 2, '.', ',')."
                                                            </div>
                                                        </div>
                                                        <div class='row' style='padding:20px'>
                                                            <div class='col-md-4'><b>SELLER</b>
                                                            </div>
                                                            <div class='col-md-8'>{$product['full_name']}
                                                            </div>
                                                        </div>
                                                        <div class='row' style='padding:20px'>
                                                            <div class='col-md-4'><b>ADDRESS</b>
                                                            </div>
                                                            <div class='col-md-8'>{$product['item_address']}
                                                            </div>
                                                        </div>
                                                        <div class='row' style='padding:20px'>
                                                            <div class='col-md-4'><b>MOBILE</b>
                                                            </div>
                                                            <div class='col-md-8'>{$product['item_contact_number']}
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        ";
                                        $count++;
                                        if($count == 1000){
                                            break;
                                        }
                                    } 
                                }
                            }
                            $out .= "
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Item</th>
                                    <th>Price({$currency})</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!-- End PAge Content -->
</div>
";
$footer_custom_library = "
<script src='".Functions::getBackendAssetsLink()."/js/lib/morris-chart/raphael-min.js'></script>
<script src='".Functions::getBackendAssetsLink()."/js/lib/morris-chart/morris.js'></script>
<script src='".Functions::getBackendAssetsLink()."/js/lib/morris-chart/dashboard1-init.js'></script>

<script src='".Functions::getBackendAssetsLink()."/js/lib/calendar-2/moment.latest.min.js'></script>
<script src='".Functions::getBackendAssetsLink()."/js/lib/calendar-2/semantic.ui.min.js'></script>
<script src='".Functions::getBackendAssetsLink()."/js/lib/calendar-2/prism.min.js'></script>
<script src='".Functions::getBackendAssetsLink()."/js/lib/calendar-2/pignose.calendar.min.js'></script>
<script src='".Functions::getBackendAssetsLink()."/js/lib/calendar-2/pignose.init.js'></script>

<script src='".Functions::getBackendAssetsLink()."/js/lib/owl-carousel/owl.carousel.min.js'></script>
<script src='".Functions::getBackendAssetsLink()."/js/lib/owl-carousel/owl.carousel-init.js'></script>

<script src='".Functions::getBackendAssetsLink()."/js/lib/datatables/datatables.min.js'></script>
<script src='".Functions::getBackendAssetsLink()."/js/lib/datatables/datatables-init.js'></script>
";
$out .= include "src/Views/dashboardfooter.php";
return $out;