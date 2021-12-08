
<?php 
use Models\Functions;
$currency = Functions::getGeoInformation("currency");
$out = "";
$out .="

        <div class='product product-single' style='max-width:80%; max-height:600px; padding:30px;overflow-y: scroll;overflow-x: scroll'>
        
            <div class='row gutter-lg'>
                <div class='col-md-4 mb-4 mb-md-0'>
                    <div class='product-gallery product-gallery-sticky'>
                        <div class='swiper-container product-single-swiper swiper-theme nav-inner' data-swiper-options=\"{
                                        'navigation': {
                                            'nextEl': '.swiper-button-next',
                                            'prevEl': '.swiper-button-prev'
                                        }
                                    }\">
                                        <div class='swiper-wrapper row cols-1 gutter-no'>
                                         ";
                                    $all_product_images = Functions::getProductImages($id);
                                    foreach($all_product_images as $product_image){
                                        $out .= "
                                            <div class='swiper-slide'>
                                                <figure class='product-image'>
                                                    <img src='{$this->page->link}/vensle-assets/backend/images/uploads/{$id}/{$product_image['id']}.{$product_image['ext']}'
                                                        data-zoom-image='{$this->page->link}/vensle-assets/backend/images/uploads/{$id}/{$product_image['id']}.{$product_image['ext']}'
                                                        alt='{$product['title']}' style='width:600px; height:400px; objext-fit:cover !important;'>
                                                </figure>
                                            </div> ";
                                    }
                                    $out .= "
                                                                              
                                        </div>
                                        <button class='swiper-button-next'></button>
                                        <button class='swiper-button-prev'></button>
                                        <!--<a href='#' class='product-gallery-btn product-image-full'><i class='w-icon-zoom'></i></a> -->
                                        <div class='product-label-group'>";
                                        if($product['sold'] == 1) {
                                            $out .= "
                                            <label class='product-label label-hot'>This item has been Sold</label>";
                                        }elseif($product['approved'] == 0) {    
                                            $out .= "
                                            <label class='product-label label-discount'>This item is pending</label>";
                                        }elseif($product['approved'] == 2) {
                                            $out .= " 
                                            <label class='product-label label-discount'>This item was declined</label>";
                                        } 
                                        $out .= "
                                        </div>
                                    </div>
                                    <div class='product-thumbs-wrap swiper-container' data-swiper-options=\"{
                                'navigation': {
                                    'nextEl': '.swiper-button-next',
                                    'prevEl': '.swiper-button-prev'
                                }
                            }\">
                            <div class='product-thumbs swiper-wrapper row cols-4 gutter-sm'>";
                             $all_product_images = Functions::getProductImages($id);
                                    foreach($all_product_images as $product_image){
                                        $out .= "
                                            
                                        <div class='product-thumb swiper-slide'>
                                            <img src='{$this->page->link}/vensle-assets/backend/images/uploads/{$id}/{$product_image['id']}.{$product_image['ext']}'
                                                alt='{$product['title']}' style='width:100%; height:100%'>
                                        </div>";
                                    }
                                    $out .= "
                                </div>
                                <button class='swiper-button-next'></button>
                                <button class='swiper-button-prev'></button>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-8 mb-4 mb-md-6'>
                        <div class='product-details' data-sticky-options=\"{'minWidth': 767}\">
                            <h1 class='product-title'>{$product['title']}
                             ";
                                        if($logged_in){
                                            if(Functions::getProductById($id,true,true)){
                                               $out .= "
                                               <a href='{$this->page->link}/backend/edit/{$product['id']}/ressano/uploads=32_edit=gol/gs_l=390opd'><i class='fa fa-edit'></i></a>
                                               "; 
                                            }
                                        }
                                        $out .= "
                                         <small>";
                                            $out .= $product['item_condition'] == 1 ? '<span class=\'tip tip-new\'>NEW<span>':'<span class=\'tip tip-hot\'>USED</span>';
                                            $out .= "
                                            </small>
                            </h1>
                            <div class='product-bm-wrapper'>
                                
                                <div class='product-meta'>
                                    <div class='product-categories'>
                                        Category:
                                        <span class='product-category'><a href='#'>{$product['category_name']}</a></span>
                                    </div>
                                    <div class='product-sku'>
                                        Reference No.: <span>".strtoupper($product['ref_no'])."</span>
                                    </div>
                                </div>
                            </div>
                            <hr class='product-divider'>

                            <div class='product-price'>
                                <ins class='new-price'>{$currency}".number_format($product['price'], 2, '.', ',')."</ins>
                            </div>
                            <div class='product-short-desc'>
                                <ul class='list-type-check list-style-none'>
                                    <li><b>Group: </b>{$product['group_name']}</li>
                                    <li><b>Category: </b>{$product['category_name']}</li>
                                    <li><b>Condition</b>";$out .= "<small>";
                                    $out .= $product['item_condition'] == 1 ? '<span class=\'tip tip-new\'>NEW<span>':'<span class=\'tip tip-hot\'>USED</span>';
                                    $out .= "</small>.</li>
                                    <li><b>Address: </b>{$product['item_address']}</li>
                                    <li><b>Mobile: </b><a href='tel:{$user['phone']} '>{$user['phone']}</a></li>
                                </ul>
                                
                            </div>
                            <hr class='product-divider'>
                            <h3><i class='prDltIcn'></i>PRODUCT DESCRIPTION</h3><hr>
                            <div class='row'>
                                <section style='
                                    min-height: 200px;
                                    max-height: 250px;
                                    overflow-y: scroll;
                                '>
                                    <div class='col-md-12'>
                                        <p class='dscrptn'>{$product['description']}</p>
                                        
                                    </div>
                                </section>
                            </div>

                            <hr class='product-divider'>
                            <div class='btn-wrap '>
                                 <a href='{$this->page->link}/customers-profile/y_in/{$user['id']}/odp_79lkoipsy/verslkj%=op' class='btn btn-link btn-primary btn-simple'>Vendor Info</a>
                             </div>
                             <div>
                                <div class='vendor-name'><h5> Name : <a href='#'>{$user['full_name']}</h5></a></div>
                                <div class='vendor-name'><h5> Address : <a href='#'>{$product['item_address']}</h5></a></div>
                                <div class='vendor-name'><h5> Mobile : <a href='#'>{$user['phone']}</h5></a></div>
                                
                            </div>
                            <div class='btn-group'
                                <div class='btn-wrap'>
                                     <a href='{$this->page->link}/customers-profile/y_in/{$user['id']}/odp_79lkoipsy/verslkj%=op' class='btn btn-success btn-rounded btn-icon-right ml-4 mb-2 mr-2'>
                                          Profile<i class='w-icon-store'></i>
                                     </a>";
                                     if(Functions::checkIfUserIsLoggedIn()) {
                                        $out .= "

                                     <a href='{$this->page->link}/backend/message-compose/weib_ein={$user['id']}&prod_indent={$id}&bibchen_val=290_oi%90%' class='btn btn-warning btn-rounded btn-icon-right mb-2 ml-2'>
                                         Chat<i class='w-icon-comments-solid'></i>
                                     </a>";
                                      }else {
                                        $out .= "
                                         <a href='#' class='btn btn-secondary btn-rounded btn-icon-right mb-2 ml-2'>
                                         Chat<i class='w-icon-comments-solid'></i>
                                     </a>";
                                 }
                                    $out .= "
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                        
                    </div>
                </div>
               
            </div>
            <button title='Close (Esc)' type='button' class='mfp-close'>×</button>
        </div>
    
    
    ";
$remove_jquery = false;
$product_id = $id;
$user_id = $user['id'];
echo $out;
?>