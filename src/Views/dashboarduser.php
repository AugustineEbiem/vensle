<?php
use Models\Functions;
$o = "
<div class='row'>
<div class='col-lg-3 dshSmr1 p-r-0'>

    <div class='lstSmWp'>
        <div class='lwTl'>
            <h3>Products</h3>
        </div>
        <div class='lSBtmWp'>
        <div class='lstSm'>
            <h1>{$number_of_users_products}</h1>
        </div>
        <div class='lstSmBtm'>
        <p>(inc. sold products)</p> 
    </div>
    
</div>
</div>
</div>
<div class='col-lg-3 dshSmr1 p-r-0'>

                        <div class='lstSmWp sm2'>
                            <div class='lwTl'>
                                <h3>Sold Items</h3>
                            </div>
                            <div class='lSBtmWp'>
                                <div class='lstSm'>
                                    <h1>{$currency}
";
$o .= number_format($sold_sum['prod_sum'], 0, '.', ',');
$o .= "
</h1>
</div>
</div>
</div>
</div>
<div class='col-lg-6 dsChtWrp'>
                        <div class='bg-white dsCht'>
                                <h4 style='visibility: hidden;' class='card-title'>Extra Area Chart</h4>
                                <div id='extra-area-chart'></div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                <div class='col-lg-12'>
                    <div class='row p-t-12 p-b-10'>
                        <div class='col-8'>
                            <h4 class='lsTrtl'>Most Recent Items</h4>
                        </div>
                        <div class='col-4'>
                            <a href='{$this->page->link}/backend/my-products' class='lsTVwAl'>View all</a>
                        </div>
                    </div>
                    <div class='lsTrnBtm'>
                    <div class='container-fluid'>
                        <!-- Start Page Content -->
";
if($number_of_my_products > 0){
    foreach($my_products as $product){
        $o .= "
        <div class='row bg-white m-b-8 dshLstWrpRw'>
        <div class='col-md-3 p-l-0 dshLstImgWp'>
            <img src='";
        $o .= (isset($product['display'])) ? "{$this->page->link}/vensle-assets/backend/images/uploads/{$product['id']}/{$product['display']}.{$product['ext']}":"{$this->page->link}/vensle-assets/backend/images/default.gif";
        $o.= "'>
        </div>
        <div class='col-md-6 DshlstFts'>
                                <h3 class='m-b-0 m-t-4'>{$product['title']}</h3>
                                <p><i class='fa fa-map-marker m-r-4'></i>{$product['item_address']} {$product['state']}</p>
                                <div class='row'>
                                    <div class='col-md-6'>
                                        
                                        <div class='b'>
                                            <div><i class='fa fa-language e'></i></div>
                                            <div class='f'>Category: <b>{$product['category_name']}</b></div>
                                        </div>
                                        <div class='b'>
                                            <div><i class='fa fa-level-up e'></i></div>
                                            <div class='f'>Condition: <b>";
        $o.= ($product['item_condition'] == 1) ? "<span class='badge badge-success'>NEW<span>":"<span class='badge badge-primary'>USED</span>" ;
        $o.= "</b> </div>
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
            							
                                        <span class='label label-rouded label-primary'><i class='fa fa-check m-r-5'></i>Status: ONLINE</span>
            							<br><br>
            							
            							
            							<div class='b'>
                                            <!-- <div><i class='fa fa-tag e'></i></div> -->
                                            <div class='f m-t-10'> <a class='text-primary' href='{$this->page->link}/single-item/{$product['id']}/huioh43940-80'>View on Website</a> </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class='col-lg-3 lstDscp'>
                                <h4 class='m-b-0 m-t-9'>Description</h4>
                                <p class='m-b-20'>{$product['description']}...</p>
                                <h3 class='m-b-0'>
    
";
if($product['approved'] == 1){
    $o .= "<span class='badge badge-success myAprv'><i class='fa fa-check'></i>Approved</span>";
}elseif($product['approved'] == 0){
    $o .= "<span class='badge badge-info myAprv'><i class='fa fa-check'></i>Pending</span>";
}else{
    $o .= "<span class='badge badge-danger myAprv'><i class='fa fa-thumbs-down'></i>Declined</span>";
}
$o .= "     <?php }?>    
</h3>
<div class='row lstBtnWrp'>
    <div class='lstEdtBtn mr-2'>
        <a class='btn btn-default btn-rounded' href='".Functions::getPageUrl("/backend")."/edit-item/?bibchen={$product['id']}&eup=rsano3/listing/gs_l=16d'><i class='fa fa-edit'></i> Edit</a>
    </div>";
    if($product['approved'] == 1){
        $o .= "<div class='lstdltBtn'>
        <a class='btn btn-success btn-flat btn-addon btn-xs' href='".Functions::getPageUrl("/backend")."/convert-sold?nupeq={$product['id']}&eup=rsano3/listing/gs_l=16_erwidern'><i class='fa fa-handshake-o'></i> Sold</a>
    </div>";
    }
    $o .= "<div class='lstdltBtn'>
    <a class='btn btn-success btn-flat btn-addon btn-xs' href='".Functions::getPageUrl("/backend")."/convert-sold?nupeq={$product['id']}&eup=rsano3/listing/gs_l=16_erwidern'><i class='fa fa-handshake-o'></i> Sold</a>
</div>
<div class='lstdltBtn ml-2'>
                                        <a class='btn btn-danger btn-flat btn-addon btn-xs' data-toggle='modal' data-target='#apv_{$product['id']}delete' ><i class='fa fa-close'></i> Delete</a>

            						</div>
                                </div>
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

                        

                        <div class='text-center'>
                          <a href='".Functions::getPageUrl("/private")."/delete-product?verste={$product['id']}&eup=rsano3/listing/gs_l=16'  name='delete' class='btn btn-danger my-4'>Delete</a>
                          <button type='button' class='btn btn-success' data-dismiss='modal'>Back</button>
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
    $o .= "<p class='p-t-10'>You currently do not have any product</p>";
}
$o .= "
<!-- End Page Content -->
</div>
</div>
</div>
</div>";
return $o;