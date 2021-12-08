<?php

use Models\Functions;

$out = "
<!-- Container fluid  -->
<div class='container-fluid'>
            <!-- Start Page Content -->
";
$find_my_products = Functions::getAllProducts('no');
if($find_my_products){
    $number_of_find_my_products = count($find_my_products);
}else{
    $number_of_find_my_products = 0;
}
if($number_of_find_my_products > 0){
    foreach($find_my_products as $product){
        $out .= "
        <div class='row bg-white m-b-8 dshLstWrpRw'>
        <div class='col-md-3 p-l-0 dshLstImgWp'>
            <img src='
        ";
        $out.= (isset($product['display'])) ? Functions::getBackendAssetsLink().'/images/uploads/'. $product['id'] . '/' . $product['display'] .'.'.$product['ext']:Functions::getBackendAssetsLink().'images/default.gif';
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
            						</div>
                                    <div class='col-md-6'>
        ";

        if($product['price'] == 0){
            $prrice = 'Call Me.';
            //$currency = '';

        }else{
            $prrice = number_format($product['price'], 2, '.', ',');
        }

        $out .= "
            <div class='b'>
            <div><i class='fa fa-tag e'></i></div>
            <div class='f'><h5>Price: {$currency}{$prrice}  ?> </h5> </div>
        </div>
        <span class='label label-rouded label-primary'><i class='fa fa-check m-r-5'></i>Status: ONLINE</span>
            							<br><br>
                                        <div class='b'>
                                            <!-- <div><i class='fa fa-tag e'></i></div> -->
                                            <div class='f m-t-10'> <a class='text-primary' href='".Functions::getPageUrl()."/single-item/{$product['id']}/huioh43940-80'>View on Website</a> </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class='col-lg-3 lstDscp'>
                                <h4 class='m-b-0 m-t-9'>Description</h4>
                                <p class='m-b-20' style='text-overflow: ellipsis;overflow: hidden;white-space: wrap;max-width: 80%;'>{$product['description']}</p>
                                <h3 class='m-b-0'>
        ";
        if($product['approved'] == 1) {
            $out .= " <span class='badge badge-success myAprv'><i class='fa fa-check'></i>Approved</span>";
        }elseif($product['approved'] == 0) {
            $out .= "<span class='badge badge-info myAprv'><i class='fa fa-check'></i>Pending</span>";
        }else{
            $out .= "<span class='badge badge-danger myAprv'><i class='fa fa-thumbs-down'></i>Declined</span>";
        }
        $out .= "
        </h3>
        <div class='row lstBtnWrp'>
            <div class='lstEdtBtn mr-2'>
                <a class='btn btn-default btn-rounded' href='".Functions::getPageUrl("backend")."/edit-item?bibchen={$product['id']}&eup=rsano3/listing/gs_l=16d'><i class='fa fa-edit'></i> Edit</a>
            </div>
        ";
        if($product['approved'] == 1) {
           $out .= "
           <div class='lstdltBtn'>
           <a class='btn btn-success btn-flat btn-addon btn-xs' href='".Functions::getPageUrl("backend")."/convert-sold?nupeq={$product['id']}&eup=rsano3/listing/gs_l=16_erwidern'><i class='fa fa-handshake-o'></i> Sold</a>
       </div>
           "; 
        }
        $out .= "<div class='lstdltBtn ml-2'>
        <a class='btn btn-danger btn-flat btn-addon btn-xs' data-toggle='modal' data-target='#apv_{$product['id']}delete'><i class='fa fa-close'></i> Delete</a>

    </div>
</div>
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

                        

";
$out .= "
<div class='text-center'>
                          <a href='".Functions::getPageUrl()."/private/delete-product?verste={$product['id']}&eup=rsano3/listing/gs_l=16'  name='delete' class='btn btn-danger my-4'>Delete</a>
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

";





    }
}else{
    $out .= "You do not have any Product.";
}
$out .= "  <!-- End Page Content -->
</div>  



</div>

</div>
<!-- End Wrapper -->";
return $out;