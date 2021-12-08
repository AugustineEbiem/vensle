<?php

use Models\Functions;

$out = "
<!-- Container fluid  -->
 <div class='container-fluid'>
            <!-- Start Page Content -->
                        <div class='row m-b-8'>
                    ";
$find_my_products = Functions::getMyRequests($is_admin);
if($find_my_products){
    $number_find_my_products = count($find_my_products);
}else{
    $number_find_my_products = 0;
}
if($number_find_my_products > 0){
    foreach($find_my_products as $product){
        $out .= "
        <div class='col-md-12'>
        <div class='row bg-white' style='margin:8px'>
            <div class='col-md-3 p-l-0 '>
            <img src='
        ";
        $out.= (isset($product['display'])) ? Functions::getBackendAssetsLink().'/images/requests/'. $product['display'] : Functions::getBackendAssetsLink().'images/default.gif';
        $out .= "
        ' style='height: 200px; border-radius: 8px;'>
        </div>
        <div class='col-md-6 DshlstFts'>
            <h3 class='m-b-0 m-t-4'>{$product['title']}</h3>
            <p><i class='fa fa-map-marker m-r-4'></i>{$product['item_address']}, {$product['state']}</p>
            <div class='row'>
                <div class='col-md-6'>
                    
                    <div class='b'>
                        <div><i class='fa fa-language e'></i></div>
                        <div class='f'>Category: <b>{$product['category_name']}</b></div>
                    </div>
                    <div class='b'>
                        <div><i class='fa fa-level-up e'></i></div>
                        <div class='f'>Condition: <b>";
                        $out .= ($product['item_condition'] == 1) ? "<span class='badge badge-success'>NEW<span>":"<span class='badge badge-primary'>USED</span>";
                        $out .= "</b> </div>
                    </div>
                    <div class='b'>
                                                <div><i class='fa fa-tag e'></i></div>
                                                <div class='f'><p>Ref No. : {$product['ref_no']}</p> </div>
                                        </div>
            						</div>";
        $out .= "<div class='col-md-5 '>
        <div class='b'>
            <p><span class='label label-rouded label-primary'><i class='fa fa-check m-r-5'></i>Status: ONLINE</span></p>                                         
        </div>
        <div class='b'>
        Min Price : <b> {$currency}".number_format($product['min_price'], 2, '.', ',')."</b>
        </div>
        <div class='b'>
            Max Price : <b> {$currency}".number_format($product['max_price'], 2, '.', ',')."
            </b>
                                                            </div>
                                                            
                                                            <div class='b'>
                                                            <div class='f m-t-10'> <a class='text-primary' href='".Functions::getPageUrl("/backend")."/single-req-item/{$product['id']}/huioh43940-80'>View on Website</a> </div>
                                                            </div>      
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class='col-md-3 lstDscp'>
                                                    <h4 class='m-b-0 m-t-9'>Description</h4>
                                                    <p class='m-b-20'>{$product['description']}...</p>
                                                    <h3 class='m-b-0'>
        
        
        ";
        if($product['approved'] == 1){
            $out .= "<span class='badge badge-success myAprv'><i class='fa fa-check'></i>Approved</span>";

        }elseif($product['approved'] == 0){
            $out .= "<span class='badge badge-info myAprv'><i class='fa fa-check'></i>Pending</span>";
        }else{
            $out .= "<span class='badge badge-danger myAprv'><i class='fa fa-thumbs-down'></i>Declined</span>";
        }
        $out .= " </h3>
        <div class='col-10'>
            <div class='row lstBtnWrp'>
                    <div class='lstEdtBtn mr-2'>
                        <a class='btn btn-success btn-xs' href='".Functions::getPageUrl("/backend")."/edit-request/{$product['id']}/\$lipno_985up'><i class='fa fa-edit'></i> Edit</a>
                    </div>
                    <div class='lstdltBtn ml-0'>
                    <button class='btn btn-danger btn-flat btn-addon btn-xs' data-toggle='modal' data-target='#apv_{$product['id']}delete'><i class='fa fa-close'></i> Delete</button>

                </div>
            </div>

            <div class='modal fade' id='apv_{$product['id']}delete'>
      <div class='modal-dialog mt-1'>
          <div class='modal-content'>
            <div class='example-wrap mb-0'>
                <div class='row justify-content-center pb-2' style='z-index: 2; position: relative;'>
          

                    <div class='col-lg-12'>
                          <div class='text-muted text-center mb-3'>
                            <h1 class=''><small>Are you sure you want to delete Request</small></h1>
                          </div>
                    </div>

                    <div>
                        <p>Request name: <b>{$product['title']}</b></p>
                    </div>

                    <div class='px-lg-5 py-lg-5 col-lg-12'>
                    
                        <input type='hidden' value='{$product['id']}' name='dcln_id'>

                        

                        <div class='text-center'>
                          <a href='".Functions::getPageUrl()."/private/delete-request?hilfe={$product['id']}/&eup=rsano3/listing/gs_l=16' name='decline' class='btn btn-danger my-4'>Delete</a>
                          <button type='button' class='btn btn-success' data-dismiss='modal'>Back</button>
                        </div>

                    
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
                                                    
                                                </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                    
                    ";
                                   
    }
}else{
    $out .= "You Have not sent any requests.";
}
$out .= "</div>

<!-- End Page Content -->
</div>  ";
$out .= include "src/Views/dashboardfooter.php";
return $out;