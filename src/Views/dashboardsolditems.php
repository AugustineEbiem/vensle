<?php

use Models\Functions;

$out = " <!-- Container fluid  -->
<div class='container-fluid'>
           <!-- Start Page Content -->";
$find_my_products = Functions::getAllProducts('yes');
if($find_my_products){
    $number_of_find_my_products = count($find_my_products);
}else{
    $number_of_find_my_products = 0;
}
if($number_of_find_my_products > 0){
    foreach($find_my_products as $product){
        $out .= " <div class='row bg-white m-b-8 dshLstWrpRw'>
        <div class='col-md-3 p-l-0 dshLstImgWp'>
            <img src='";
        $out .=  (isset($product['image_id'])) ? Functions::getBackendAssetsLink().'images/uploads/'. $product['product_id'] . '/' . $product['image_id'] .'.'.$product['ext']: Functions::getBackendAssetsLink().'images/default.gif';
        $out .= "
        '>
        </div>
        <div class='col-md-6 DshlstFts'>
            <h3 class='m-b-0 m-t-4'>{$product['title']}</h3>
            <p><i class='fa fa-map-marker m-r-4'></i> {$product['item_address']}, {$product['state']}</p>
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
                                </div>
                                <div class='col-md-6'>
                            
                            <div class='b'>
                                <div><i class='fa fa-tag e'></i></div>
                                <div class='f'><h5>Price: {$currency}".number_format($product['price'], 2, '.', ',')."</h5> </div>
                            </div>
                            
                            <span class='label label-rouded label-warning'><i class='fa fa-check m-r-5'></i>Status: OFFLINE</span>
                            <br><br>
                            
                            
                            <div class='b'>
                                <!-- <div><i class='fa fa-tag e'></i></div> -->
                                <div class='f m-t-10'> <a class='text-primary' href='{$this->page->link}/single-item.php/{$product['id']}/huioh43940-80'>View on Website</a> </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class='col-lg-3 lstDscp'>
                    <h4 class='m-b-0 m-t-9'>Description</h4>
                    <p class='m-b-20'>{$product['description']} ...</p>
                    <h3 class='m-b-0'><span class='badge badge-warning myAprv'><i class='fa fa-check'></i>SOLD</span></h3>
                    <div class='row lstBtnWrp'>
                        <div class='lstEdtBtn mr-2'>
                            <a class='btn btn-default btn-rounded' href='".Functions::getPageUrl("backend")."edit-item/?bibchen={$product['id']}&eup=rsano3/listing/gs_l=16d'><i class='fa fa-edit'></i> Edit</a>
                        </div>
                        <div class='lstdltBtn'>
                            <a class='btn btn-danger btn-flat btn-addon btn-xs' href='{$this->page->url}/private/delete-product/?verste={$product['id']}&eup=rsano3/listing/gs_l=16'><i class='fa fa-close'></i> Delete</a>
                        </div>
                    </div>

                </div>
            </div>
                                        
        ";
    }
}else{
    $out .= "You do not have any Product.";
}
$out .= "
<!-- End Page Content -->
</div>  



</div>

</div>
<!-- End Wrapper -->
";


return $out;