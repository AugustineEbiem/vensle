<?php

use Models\Functions;
$currency = Functions::getGeoInformation("currency");
$out = include "src/Views/homenav.php";
$out .="
    <main class='main mb-10 pb-1'>
        <!-- Start of Breadcrumb -->
        <nav class='breadcrumb-nav container'>
            <ul class='breadcrumb bb-no'>
                <li><a href='{$this->page->link}'>Home</a></li>
                <li>Product</li>
                <li>{$product['title']}</li>
            </ul>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->

        <div class='page-content'>
            <div class='container'>
                <div class='row gutter-lg'>
                        <div class='product product-single row mb-2'>
                            <div class='col-md-4 mb-6'>
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
                                                        alt='{$product['title']}' style='width:100%; height:400px; objext-fit:contain !important;'>
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
                                                alt='{$product['title']}' width='800' height='900'>
                                        </div>";
                                    }
                                    $out .= "
                                </div>
                                <button class='swiper-button-next'></button>
                                <button class='swiper-button-prev'></button>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4 mb-4 mb-md-6'>
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
                            
                            <div class='btn-group'
                                <div class='btn-wrap'>
                                     
                                </div>
                                
                            </div>
                            
                        </div>
                        <aside class='sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper'>
                            <div class='sidebar-overlay'></div>
                            <a class='sidebar-close' href='#'><i class='close-icon'></i></a>
                            <a href='#' class='sidebar-toggle d-flex d-lg-none'><i class='fas fa-chevron-left'></i></a>
                            <div class='sidebar-content scrollable'>
                                <div class='pin-wrapper' style='height: 969.5px;'>
                                <div class='sticky-sidebar' style='border-bottom: 0px none rgb(102, 102, 102); width: 279.961px;'>
                                    <div class='widget widget-banner mb-9'>
                                        <div class='banner banner-fixed br-sm'>
                                            <figure>
                                                <img src='../../vensle-assets/V11/images/shop/banner3.jpg' alt='Banner' width='266' height='220' style='background-color: #1D2D44;'>
                                            </figure>
                                            <div class='banner-content'>
                                                <div class='banner-price-info font-weight-bolder text-white lh-1 ls-25'>
                                                    40<sup class='font-weight-bold'>%</sup><sub class='font-weight-bold text-uppercase ls-25'>Off</sub>
                                                </div>
                                                <h4 class='banner-subtitle text-white font-weight-bolder text-uppercase mb-0'>
                                                    Ultimate Sale</h4>
                                            </div>
                                        </div>
                                    </div>
                                   <div class='col-md-12  mb-2 mb-md-6'>
                                        <div class='btn-wrap '>
                                             <a href='{$this->page->link}/customers-profile/y_in/{$user['id']}/odp_79lkoipsy/verslkj%=op' class='btn btn-link btn-primary btn-simple'>Vendor Info</a>
                                         </div>
                                         <div class='mb-4'>
                                            <div class='vendor-name'><h5> Name : <a href='#'>{$user['full_name']}</h5></a></div>
                                            <div class='vendor-name'><h5> Address : <a href='#'>{$product['item_address']}</h5></a></div>
                                            <div class='vendor-name'><h5> Mobile : <a href='#'>{$user['phone']}</h5></a></div>
                                            
                                        </div>
                                        <div class='btn-group'
                                            <div class='btn-wrap'>
                                                 <a href='{$this->page->link}/customers-profile/y_in/{$user['id']}/odp_79lkoipsy/verslkj/' class='btn btn-success btn-rounded btn-icon-right ml-4 mb-2 mr-2'>
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
                                               <hr class='product-divider'>
                                        <h4><i class='prDltIcn'></i>PRODUCT DESCRIPTION</h4><hr>
                                        <div class='row'>
                                            <section style='
                                                min-height: 200px;
                                                max-height: 300px;
                                                overflow-y: scroll;
                                            '>
                                                <div class='col-md-12'>
                                                    <p class='dscrptn'>{$product['description']}</p>
                                                    
                                                </div>
                                            </section>
                                        </div>
                                        <hr class='product-divider'>
                                        
                                </div>
                                    <!-- End of Widget Icon Box -->
                        
                                    
                                </div>
                            </div>
                        </aside>
                    </div>
                    
                    
                    
                    <section class='vendor-product-section'>
                    <div class='title-link-wrapper mb-4'>
                        <h4 class='title text-left'>Similar Products </h4>
                        <a href='{$this->page->link}/customers-profile/y_in/{$user['id']}/odp_79lkoipsy/verslkj%=op' class='btn btn-dark btn-link btn-slide-right btn-icon-right'>More
                            Products<i class='w-icon-long-arrow-right'></i></a>
                    </div>
                    <div class='swiper-container swiper-theme' data-swiper-options=\"{
                        'spaceBetween': 20,
                        'slidesPerView': 2,
                        'breakpoints': {
                            '576': {
                                'slidesPerView': 3
                            },
                            '768': {
                                'slidesPerView': 4
                            },
                            '992': {
                                'slidesPerView': 4
                            }
                        }
                    }\">

                    <div class='swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2'>";
                        if(!empty($similar)) {
                            foreach ($similar as $prod) {
                                $suggested_product = Functions::getProductDetailsById($prod["id"]);
                                $out .= "
                        <div class='swiper-slide product'>
                            <figure class='product-media'>
                                <a href='{$this->page->link}/single-item/{$suggested_product['id']}/huioh43940-80'>
                                    <img src='{$this->page->link}/vensle-assets/backend/images/uploads/{$suggested_product['id']}/{$suggested_product['image_id']}.{$suggested_product['ext']}' alt='{$suggested_product['title']}'
                                        style='width:100%; height:250px; objext-fit:cover !important;' />
                                    <img src='{$this->page->link}/vensle-assets/backend/images/uploads/{$suggested_product['id']}/{$suggested_product['image_id']}.{$suggested_product['ext']}' alt='{$suggested_product['title']}'
                                       style='width:100%; height:250px; objext-fit:contain !important;'  />
                                </a>
                                <div class='product-action'>
                                    <a href='{$this->page->link}/product-view/".$suggested_product['id']."/huioh43940-80' class='d-lg-show login sign-in btn-product' title='Quick View'>Quick
                                        View</a>
                                </div>
                            </figure>
                            <div class='product-details'>
                                <div class='product-cat'><a href=''>{$suggested_product['category_name']}</a>
                                </div>
                                <h4 class='product-name'><a href='{$this->page->link}/single-item/{$suggested_product['id']}/huioh43940-80'>{$suggested_product['title']}</a>
                                </h4>
                                <div class='product-pa-wrapper'>
                                    <div class='product-price'>{$currency}".number_format($suggested_product['price'])."</div>
                                </div>
                            </div>
                        </div>";
                            }
                        }
                        $out .= "        
                    </div>
                </div>
            </section>
            <section class='related-product-section'>
                    <div class='title-link-wrapper mb-4'>
                        <h4 class='title'>Recently view products</h4>
                        <a href='#' class='btn btn-dark btn-link btn-slide-right btn-icon-right'>More
                            Products<i class='w-icon-long-arrow-right'></i></a>
                    </div>
                    <div class='swiper-container swiper-theme' data-swiper-options=\"{
                        'spaceBetween': 20,
                        'slidesPerView': 2,
                        'breakpoints': {
                            '576': {
                                'slidesPerView': 3
                            },
                            '768': {
                                'slidesPerView': 6
                            },
                            '992': {
                                'slidesPerView': 6
                            }
                        }
                    }\">
                        <div class='swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2'>";
                            if(!empty($uniq_recnt)){
                                foreach (array_unique($uniq_recnt) as $recent_prod) {
                                    if(is_numeric($recent_prod)){
                                        $recent_product = Functions::getProductDetailsById($recent_prod,$check_aprroved);
                                    }
                                   $out .= "                   
                            <div class='swiper-slide product'>
                                <figure class='product-media'>
                                    <a href='{$this->page->link}/single-item/".$recent_product['id']."/huioh43940-80'>
                                        <img src='{$this->page->link}/vensle-assets/backend/images/uploads/{$recent_product['id']}/{$recent_product['image_id']}.{$recent_product['ext']}' alt='Product'
                                            style='width:100%;height:250px;object-fit:contain !imporant' />
                                    </a>
                                    
                                    <div class='product-action'>
                                        <a href='{$this->page->link}/product-view/".$recent_product['id']."/huioh43940-80' class='d-lg-show login sign-in btn-product'  title='Quick View'>Quick
                                            View</a>
                                    </div>
                                </figure>
                                <div class='product-details'>
                                    <h4 class='product-name'><a href='{$this->page->link}/single-item/".number_format($recent_product['id'])."/huioh43940-80'>{$recent_product['title']}</a></h4>
                                    
                                    <div class='product-pa-wrapper'>
                                        <div class='product-price'>{$currency}".number_format($recent_product['price'])."</div>
                                    </div>
                                </div>
                            </div>";
                                }
                            }
                            $out .= "                            
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
";

$remove_jquery = false;
$out .= include "homefooter.php";
$product_id = $id;
$user_id = $user['id'];
$out .= include "homemodals.php";

return $out;