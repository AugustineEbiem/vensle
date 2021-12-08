<?php

use Models\Functions;

$all_products = Functions::getSectionedProducts('no',$is_admin,$country,$group_id,$cat_id);
print_r($all_products);
$out = "";                        

        if(count($all_products) > 0){
            $ccnt = 0;
            foreach($all_products as $product){
                $feat = ($product['featured'] == 1) ? "<a href='javascript:void(0)' onclick='unfeatureProduct({$product['id']})' class='btn btn-warning btn-outline btn-rounded ' ><i class='fa fa-tag'></i> Unfeature </a>" : "<a  onclick='unfeatureProduct({$product['id']})' href='javascript:void(0)' class='btn btn-dark btn-outline btn-rounded ' onclick='featureProduct({$product['id']})' ><i class='fa fa-tag'></i> Feature </a>" ;
                $ccnt++;
                $out .= "
            <tr>
                <td>{$ccnt}</td>
                <td>
                    <div class='rect-img'>
                        <a href='#'><img src='";
                         $out .= (isset($product['image_id'])) ? Functions::getBackendAssetsLink().'/images/uploads/'. $product['id'] .'/thumb_'. $product['image_id'] .'.'.$product['ext']:  Functions::getBackendAssetsLink().'/images/default.gif';
                        $out .= "' style='border-radius:8px;'></a>
                        ";
                    $out .= ($product['item_condition'] == 1) ? "<span class='badge badge-success'>NEW<span>":"<span class='badge badge-primary'>OLD</span>" ;
                    $out .= "
                    </div>
                </td>
                <td><span><a href='#' data-toggle='modal' data-target='#r{$product['id']}'>
                    {$product['title']}</a></span>
                </td>
                <!--<td><span>".number_format($product['price'], 2, '.', ',')."</span>-->
                </td>
                <td><span>{$product['ref_no']}</span>
                </td>
                <!--<td><span>{$product['item_contact_number']}</span></td>--> 
                <td>
                    {$product['country']}
                </td>
                <td><span>{$product['category_name']}</span></td>
                <td><span>".date('d/m/Y', strtotime($product['upload_date']))."</span></td>
                
                <td style='display:flex; border 0px !important '>
                    <span class='ml-2'>
                        <a class='btn btn-danger btn-outline btn-rounded' data-toggle='modal' data-target='#apv_{$product['id']}delete'><i class='fa fa-trash'></i> Delete</a>
                    </span>
                    <span  class='ml-2' id='feat{$product['id']}'>".$feat."</span>
                </td>
                <div class='modal fade' id='apv_{$product['id']}delete'>
                <div class='modal-dialog mt-1'>
                    <div class='modal-content'>
                        <div class='example-wrap mb-0'>
                            <div class='row justify-content-center pb-2' style='z-index: 2; position: relative;'>
                                <div class='col-lg-12'>
                                    <div class='text-muted text-center mb-3'>
                                        <h1 class=''><small>Are you sure you want to delete this Product</small></h1>
                                    </div>
                                </div>
                                <div>
                                    <p>Product name: <b>{$product['title']}</b></p>
                                </div>
                                <div class='px-lg-5 py-lg-5 col-lg-12'>
                                    <input type='hidden' value='{$product['id']}' name='dcln_id'>
                                    <div class='text-center'>
                                        <a href='".Functions::getRouteLink()."private/delete-product?verste={$product['id']}&eup=rsano3/listing/gs_l=16'  name='delete' class='btn btn-danger my-4'>Delete</a>
                                        <button type='button' class='btn btn-success' data-dismiss='modal'>Back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='modal fade' id='apv_{$product['id']}featured'>
                <div class='modal-dialog mt-1'>
                    <div class='modal-content'>
                        <div class='example-wrap mb-0'>
                            <div class='row justify-content-center pb-2' style='z-index: 2; position: relative;'>
                                <div class='col-lg-12'>
                                    <div class='text-muted text-center mb-3'>
                                        <h1 class=''><small>Are you sure you want to make this Product featured</small></h1>
                                    </div>
                                </div>
                                <div>
                                    <p>Product name: <b>{$product['title']}</b></p>
                                </div>
                                <div class='px-lg-5 py-lg-5 col-lg-12'>
                                    <input type='hidden' value='{$product['id']}' name='dcln_id'>
                                    <div class='text-center'>
                                        <a href='".Functions::getRouteLink()."private/make-featured?verste={$product['id']}&eup=rsano3/listing/gs_l=16'  name='delete' class='btn btn-success my-4'>Feature</a>
                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='modal fade' id='apv_{$product['id']}unfeature'>
                <div class='modal-dialog mt-1'>
                    <div class='modal-content'>
                        <div class='example-wrap mb-0'>
                            <div class='row justify-content-center pb-2' style='z-index: 2; position: relative;'>
                                <div class='col-lg-12'>
                                    <div class='text-muted text-center mb-3'>
                                        <h1 class=''><small>Are you sure you want to remove this Product from featured</small></h1>
                                    </div>
                                </div>
                                <div>
                                    <p>Product name: <b>{$product['title']}</b></p>
                                </div>
                                <div class='px-lg-5 py-lg-5 col-lg-12'>
                                    <input type='hidden' value='{$product['id']}' name='dcln_id'>
                                    <div class='text-center'>
                                        <a href='".Functions::getRouteLink()."private/unfeature-product?verste={$product['id']}&eup=rsano3/listing/gs_l=16'  class='btn btn-warning my-4'>Remove Feature</a>
                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Back</button>
                                    </div>
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
            </tr>
            ";
            if ($ccnt == 500) {
                // code...
                break;
            }
            }
        }else{
            $out .= "You do not have any Product.";
        }
                        
    
return $out;