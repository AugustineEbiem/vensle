<?php

use Models\Functions;



$output = "
<section class='category-section top-category bg-grey pt-10 pb-10 appear-animate'>
                <div class='container pb-2'>
                    <h2 class='title justify-content-center pt-1 ls-normal mb-5'>Top Categories </h2>
                    <div class='swiper'>
                        <div class='swiper-container swiper-theme pg-show' data-swiper-options='{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 5
                                },
                                '992': {
                                    'slidesPerView': 6
                                }
                            }
                        }'>
                            <div class='swiper-wrapper row cols-lg-6 cols-md-5 cols-sm-3 cols-2'>";
                            $categories = Functions::frontCategories();
                            foreach ($categories as $cat ) {
                                $output .="
                                <div class='swiper-slide category category-classic category-absolute overlay-zoom br-xs'>
                                    <a style='width:100%; height:80% !important;' href='search?no_filter=true&category{$cat['cat_id']}=&keywords=&no_filter=' class='category-media'>
                                        <img src='{$this->page->link}/vensle-assets/images/display_category/{$cat['image_3']}' alt='Category' style='width:100%; height:150px !important; object-fit:contain'>
                                    </a>
                                    <div class='category-content'>
                                        <h3 class='category-name text-primary' >".strtok($cat['name'],"(")."</h3>
                                        <a href='search?no_filter=true&category{$cat['cat_id']}=&keywords=&no_filter='
                                            class='btn btn-primary btn-link btn-underline text-primary'>Shop
                                            Now</a>
                                    </div>
                                </div>";

                                }
                                $output .="
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End of .category-section top-category -->

            <div class='row category-cosmetic-lifestyle appear-animate mb-5'>
            <div class='col-md-6 mb-4'>
                <div class='banner banner-fixed category-banner-1 br-xs'>
                    <figure>
                        <img src='{$this->page->link}/vensle-assets/V11/images/demos/demo1/categories/3-1.jpg' alt='Category Banner'
                            width='610' height='200' style='background-color: #3B4B48;' />
                    </figure>
                    <div class='banner-content y-50 pt-1'>
                        <h5 class='banner-subtitle font-weight-bold text-uppercase'>Natural Process</h5>
                        <h3 class='banner-title font-weight-bolder text-capitalize text-white'>Cosmetic
                            Makeup<br>Professional</h3>
                        <a href='shop-banner-sidebar.html'
                            class='btn btn-white btn-link btn-underline btn-icon-right'>Shop Now<i
                                class='w-icon-long-arrow-right'></i></a>
                    </div>
                </div>
            </div>
            <div class='col-md-6 mb-4'>
                <div class='banner banner-fixed category-banner-2 br-xs'>
                    <figure>
                        <img src='{$this->page->link}/vensle-assets/V11/images/demos/demo1/categories/3-2.jpg' alt='Category Banner'
                            width='610' height='200' style='background-color: #E5E5E5;' />
                    </figure>
                    <div class='banner-content y-50 pt-1'>
                        <h5 class='banner-subtitle font-weight-bold text-uppercase'>Trending Now</h5>
                        <h3 class='banner-title font-weight-bolder text-capitalize'>Women's
                            Lifestyle<br>Collection</h3>
                        <a href='shop-banner-sidebar.html'
                            class='btn btn-dark btn-link btn-underline btn-icon-right'>Shop Now<i
                                class='w-icon-long-arrow-right'></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Category Cosmetic Lifestyle -->
";
$count = 0;
foreach ($cat_groups as $big => $small) {
    switch($small){
        case "Vehicle (Parts & Accessories)":
            $category_id = 1;
        break;
        case "Fashion (Men & Women)":
            $category_id = 2;
        break;
        case "Electronics (Phones, Computer)":
            $category_id = 3;
        break;
        case "Collectibles & Art":
            $category_id = 4;
        break;
        case "Home & Garden":
            $category_id = 5;
        break;
        case "Sporting Goods":
            $category_id = 6;
        break;
        case "Kids (Clothing, Shoes & Accs)":
            $category_id = 7;
        break;
        case "Business and Industries":
            $category_id = 8;
        break;
        case "Musical":
            $category_id = 9;
        break;
        case "Food and Beverages":
            $category_id = 10;
        break;
        case "Books":
            $category_id = 11;
        break;
        case "Real Estate (Letting and Sales)":
            $category_id = 12;
        break;
    }


    $output .= "
    <div class='product-wrapper-1 appear-animate mb-5'>
            <div class='title-link-wrapper pb-1 mb-4'>
                <h2 class='title ls-normal mb-0'>{$small}</h2>
                <a href='{$this->page->link}/search?no_filter=true&category={$category_id}&keywords=&no_filter=' class='font-size-normal font-weight-bold ls-25 mb-0'>More
                    Products<i class='w-icon-long-arrow-right'></i></a>
            </div>
            <div class='row'>
                <div class='col-lg-3 col-sm-4 mb-4'>
                    <div class='banner h-100 br-sm' style='background-image: url({$this->page->link}/vensle-assets/V11/images/demos/demo1/banners/".($count + 2).".jpg); 
                        background-color: #ebeced;'>
                        <div class='banner-content content-top'>
                            <h5 class='banner-subtitle font-weight-normal mb-2'>Weekend Sale</h5>
                            <hr class='banner-divider bg-dark mb-2'>
                            <h3 class='banner-title font-weight-bolder ls-25 text-uppercase'>
                                New Arrivals<br> <span
                                    class='font-weight-normal text-capitalize'>Collection</span>
                            </h3>
                            <a href='shop-banner-sidebar.html'
                                class='btn btn-dark btn-outline btn-rounded btn-sm'>shop Now</a>
                        </div>
                    </div>
                </div>
                <!-- End of Banner -->

                <div class='col-lg-9 col-sm-8'>
                            <div class='swiper-container swiper-theme' data-swiper-options=\"{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                    '992': {
                                        'slidesPerView': 3
                                    },
                                    '1200': {
                                        'slidesPerView': 4
                                    }
                                }
                            }\">

            <div class='swiper-wrapper row cols-xl-4 cols-lg-3 cols-2'>

    ";
    $small_set = Functions::getGroupsCategories($names_of_small_groups[$count][2], $names_of_small_groups[$count][0]);
    if(count($small_set)){
        foreach($small_set as $small_product){
            $output .= "
            <div class='swiper-slide product-col'>
                <div class='product-wrap product text-center'>
            ";
            if($small_product['price'] <=0 ){
                $product_price = 'Contact Seller';
                //$currency = '';
            }else{
                $product_price = number_format($small_product['price'], 2, '.', ',');
                } 
            $imageLink = (isset($small_product['image_id'])) ? $this->page->link.'/vensle-assets/backend/images/uploads/'. $small_product['product_id'] . '/new_' . $small_product['image_id'] .'.'.$small_product['ext']: "{$this->page->link}/backend/images/default.gif";
            $output .= "
             <figure class='product-media'>
                <a href='#r{$small_product['id']}' class='open-popup-link' data-target='#r{$small_product['id']}'>
                <img src='".$imageLink."' alt='{$small_product['title']}'
                        width='216' height='243' />
                </a>
                <div class='product-action-vertical'>
                <a href='#' class='btn-product-icon btn-cart w-icon-cart'
                    title='Add to cart'></a>
                <a href='#' class='btn-product-icon btn-wishlist w-icon-heart'
                    title='Add to wishlist'></a>
                <a href='#' class='btn-product-icon btn-quickview w-icon-search'
                    title='Quickview'></a>
                <a href='#' class='btn-product-icon btn-compare w-icon-compare'
                    title='Add to Compare'></a>
            </div>
            </figure>
            ";
            $output .= "
            <div class='product-details'>
            <h4 class='product-name'><a href='#r{$small_product['id']}' class='open-popup-link' data-target='#r{$small_product['id']}'>{$small_product['title']}</a>
            </h4>
            <div class='ratings-container'>
                <div class='ratings-full'>
                    <span class='ratings' style='width: 60%;'></span>
                    <span class='tooltiptext tooltip-top'></span>
                </div>
                <a href='product-default.html' class='rating-reviews'>(3
                    reviews)</a>
            </div>
            <div class='product-price'>
                <ins class='new-price'>{$currency}{$product_price}</ins>
                ";
                $output.= ($small_product['item_condition'] == 1)
                ?"<span class='tip tip-success'>NEW</span>":"<span class='tip tip-hot'>USED</span>";
                $output .= "</div>
                </div>
            </div>
            </div>
            <!-- end of first loop -->
            ";


            //image links

            $output .= "
            <div  class='test mfp-hide col-lg-4 col-md-6 col-sm-8' id='r{$small_product['id']}'>
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
            $product_images = Functions::getProductImages($small_product['id']);
            $number_of_product_images = count($product_images);
            foreach($product_images as $image){
                $output .= "
                <div style='width:250px !important;' class='swiper-slide'>
                    <img style='
                    max-height: 100%;
                    max-width: 100%;
                    ' class='image' src='{$this->page->link}/vensle-assets/backend/images/uploads/{$small_product['id']}/new_{$image['id']}.{$image['ext']}'>
            </div>
                ";
            }
            
            $output .= "
            </div>
            <div class='swiper-pagination'></div>
            </div>
        </div> 
        
        <table class='table table-hover table-responsive'>
            <tbody>
            <tr>
                <th scope='row'>ITEM</th>
                <td>{$small_product['title']}
                    ";
                    $output.= ($small_product['item_condition'] == 1)
                    ?"<span class='badge badge-success'>NEW</span>":"<span class='badge badge-primary'>USED</span>";
                $output .= "</td>
            </tr>
            <tr><th scope='row'>PRICE</th>
            <td>{$currency}{$product_price}</td></tr>
            <tr><th scope='row'>SELLER</th><td>{$small_product['full_name']}</td></tr>
            <tr><th scope='row'>ADDRESS</th><td>{$small_product['item_address']}</td></tr>
            <tr><th scope='row'>MOBILE</th><td><a href='tel:".htmlentities($small_product['item_contact_number'])."'>{$small_product['item_contact_number']}</a></td></tr>
            </tbody>
        </table>                                                  
        
        <div class='modal-footer'>
            <a href='{$this->page->link}/single-item/{$small_product['id']}/huioh43940-80'  class='btn btn-primary'>View Details</a>
            <button onClick='closePopup();' type='button' class='btn btn-secondary'>Back</button>
        </div>
        </div>
    </div>
    </div>

    
        
        
        
        ";

        }
    }else{
        $output .= "There are currently no products";
    }
    $output .= " 
    </div>
<div class='swiper-pagination'></div>
</div>
</div>
</div>
</div>
<!-- End of Product Wrapper 1 -->
";

switch($big){
    case "Vehicle (Parts & Accessories)":
        $category_bid = 1;
    break;
    case "Fashion (Men & Women)":
        $category_bid = 2;
    break;
    case "Electronics (Phones, Computer)":
        $category_bid = 3;
    break;
    case "Collectibles & Art":
        $category_bid = 4;
    break;
    case "Home & Garden":
        $category_bid = 5;
    break;
    case "Sporting Goods":
        $category_bid = 6;
    break;
    case "Kids (Clothing, Shoes & Accs)":
        $category_bid = 7;
    break;
    case "Business and Industries":
        $category_bid = 8;
    break;
    case "Musical":
        $category_bid = 9;
    break;
    case "Food and Beverages":
        $category_bid = 10;
    break;
    case "Books":
        $category_bid = 11;
    break;
    case "Real Estate (Letting and Sales)":
        $category_bid = 12;
    break;
}

$output .= "
    <div class='product-wrapper-1 appear-animate mb-5'>
            <div class='title-link-wrapper pb-1 mb-4'>
                <h2 class='title ls-normal mb-0'>{$big}</h2>
                <a href='{$this->page->link}/search?no_filter=true&category={$category_bid}&keywords=&no_filter=' class='font-size-normal font-weight-bold ls-25 mb-0'>More
                    Products<i class='w-icon-long-arrow-right'></i></a>
            </div>
            <div class='row'>
                <div class='col-lg-3 col-sm-4 mb-4'>
                    <div class='banner h-100 br-sm' style='background-image: url({$this->page->link}/vensle-assets/V11/images/demos/demo1/banners/".($count + 2).".jpg); 
                        background-color: #ebeced;'>
                        <div class='banner-content content-top'>
                            <h5 class='banner-subtitle font-weight-normal mb-2'>Weekend Sale</h5>
                            <hr class='banner-divider bg-dark mb-2'>
                            <h3 class='banner-title font-weight-bolder ls-25 text-uppercase'>
                                New Arrivals<br> <span
                                    class='font-weight-normal text-capitalize'>Collection</span>
                            </h3>
                            <a href='shop-banner-sidebar.html'
                                class='btn btn-dark btn-outline btn-rounded btn-sm'>shop Now</a>
                        </div>
                    </div>
                </div>
                <!-- End of Banner -->

                <div class='col-lg-9 col-sm-8'>
                            <div class='swiper-container swiper-theme' data-swiper-options=\"{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                    '992': {
                                        'slidesPerView': 3
                                    },
                                    '1200': {
                                        'slidesPerView': 4
                                    }
                                }
                            }\">

            <div class='swiper-wrapper row cols-xl-4 cols-lg-3 cols-2'>

    ";
    $big_set = Functions::getGroupsCategories($names_of_big_groups[$count][2], $names_of_big_groups[$count][0]);
    if(count($big_set)){
        foreach($big_set as $big_product){
            $output .= "
            <div class='swiper-slide product-col'>
                <div class='product-wrap product text-center'>
            ";
            if($big_product['price'] <=0 ){
                $product_price = 'Contact Seller';
                //$currency = '';
            }else{
                $product_price = number_format($big_product['price'], 2, '.', ',');
                } 
            $imageLink = (isset($big_product['image_id'])) ? $this->page->link.'/vensle-assets/backend/images/uploads/'. $big_product['product_id'] . '/new_' . $big_product['image_id'] .'.'.$big_product['ext']: "{$this->page->link}/backend/images/default.gif";
            $output .= "
             <figure class='product-media'>
             <a href='#r{$big_product['id']}' class='open-popup-link' data-target='#r{$big_product['id']}'>
                <img src='".$imageLink."' alt='{$big_product['title']}'
                        width='216' height='243' />
                </a>
                <div class='product-action-vertical'>
                <a href='#' class='btn-product-icon btn-cart w-icon-cart'
                    title='Add to cart'></a>
                <a href='#' class='btn-product-icon btn-wishlist w-icon-heart'
                    title='Add to wishlist'></a>
                <a href='#' class='btn-product-icon btn-quickview w-icon-search'
                    title='Quickview'></a>
                <a href='#' class='btn-product-icon btn-compare w-icon-compare'
                    title='Add to Compare'></a>
            </div>
            </figure>
            ";
            $output .= "
            <div class='product-details'>
            <h4 class='product-name'><a href='#r{$big_product['id']}' class='open-popup-link' data-target='#r{$big_product['id']}'>{$big_product['title']}</a>
            </h4>
            <div class='ratings-container'>
                <div class='ratings-full'>
                    <span class='ratings' style='width: 60%;'></span>
                    <span class='tooltiptext tooltip-top'></span>
                </div>
                <a href='product-default.html' class='rating-reviews'>(3
                    reviews)</a>
            </div>
            <div class='product-price'>
                <ins class='new-price'>{$currency}{$product_price}</ins>
                ";
                $output.= ($big_product['item_condition'] == 1)
                ?"<span class='tip tip-new'>NEW</span>":"<span class='tip tip-new'>USED</span>";
                $output .= "</div>
                </div>
            </div>
            </div>
            <!-- end of first loop -->


            
            ";


            //image links

            $output .= "
            <div  class='test mfp-hide col-lg-4 col-md-6 col-sm-8' id='r{$big_product['id']}'>
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

                            <div class='swiper-wrapper'>";

                            $product_images = Functions::getProductImages($big_product['id']);
                            $number_of_product_images = count($product_images);
                            foreach($product_images as $image){
                                $output .= "
                                <div style='width:250px !important;' class='swiper-slide'>
                                    <img style='
                                    max-height: 100%;
                                    max-width: 100%;
                                    ' class='image' src='{$this->page->link}/vensle-assets/backend/images/uploads/{$big_product['id']}/new_{$image['id']}.{$image['ext']}'>
                            </div>
                                ";
                            }
                            
                            $output .= "
                            </div>
                            <div class='swiper-pagination'></div>
                            </div>
                        </div> 
                        
                        <table class='table table-hover table-responsive'>
                            <tbody>
                            <tr>
                                <th scope='row'>ITEM</th>
                                <td>{$big_product['title']}
                                    ";
                                    $output.= ($big_product['item_condition'] == 1)
                                    ?"<span class='badge badge-success'>NEW</span>":"<span class='badge badge-primary'>USED</span>";
                                $output .= "</td>
                            </tr>
                            <tr><th scope='row'>PRICE</th>
                            <td>{$currency}{$product_price}</td></tr>
                            <tr><th scope='row'>SELLER</th><td>{$big_product['full_name']}</td></tr>
                            <tr><th scope='row'>ADDRESS</th><td>{$big_product['item_address']}</td></tr>
                            <tr><th scope='row'>MOBILE</th><td><a href='tel:".htmlentities($big_product['item_contact_number'])."'>{$big_product['item_contact_number']}</a></td></tr>
                            </tbody>
                        </table>                                                  
                        
                        <div class='modal-footer'>
                            <a href='{$this->page->link}/single-item/{$big_product['id']}/huioh43940-80'  class='btn btn-primary'>View Details</a>
                            <button onClick='closePopup();' type='button' class='btn btn-secondary'>Back</button>
                        </div>
                        </div>
                    </div>
                    </div>
                
                    
                        
                        
                        
                        ";


        }
    }else{
        $output .= "There are currently no products";
    }
    $output .= " 
    </div>
<div class='swiper-pagination'></div>
</div>
</div>
</div>
</div>
<!-- End of Product Wrapper 1 -->
";
$count++;
}




//REQUESTED ITEMS

$output .= "
    <div class='product-wrapper-1 appear-animate mb-5'>
            <div class='title-link-wrapper pb-1 mb-4'>
                <h2 class='title ls-normal mb-0'>Requested Items</h2>
                <a href='shop-boxed-banner.html' class='font-size-normal font-weight-bold ls-25 mb-0'>More
                    Requests<i class='w-icon-long-arrow-right'></i></a>
            </div>
            <div class='row'>
                <div class='col-lg-3 col-sm-4 mb-4'>
                    <div class='banner h-100 br-sm' style='background-image: url({$this->page->link}/vensle-assets/V11/images/demos/demo1/banners/".($count + 2).".jpg); 
                        background-color: #ebeced;'>
                        <div class='banner-content content-top'>
                            <h5 class='banner-subtitle font-weight-normal mb-2'>Weekend Sale</h5>
                            <hr class='banner-divider bg-dark mb-2'>
                            <h3 class='banner-title font-weight-bolder ls-25 text-uppercase'>
                                New Arrivals<br> <span
                                    class='font-weight-normal text-capitalize'>Collection</span>
                            </h3>
                            <a href='shop-banner-sidebar.html'
                                class='btn btn-dark btn-outline btn-rounded btn-sm'>shop Now</a>
                        </div>
                    </div>
                </div>
                <!-- End of Banner -->

                <div class='col-lg-9 col-sm-8'>
                            <div class='swiper-container swiper-theme' data-swiper-options=\"{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                    '992': {
                                        'slidesPerView': 3
                                    },
                                    '1200': {
                                        'slidesPerView': 4
                                    }
                                }
                            }\">

            <div class='swiper-wrapper row cols-xl-4 cols-lg-3 cols-2'>

    ";

$limit = 24;
$requests = Functions::getAllRequests($limit);
if(Functions::is_countable($requests)){
    foreach($requests as $request){
        $output .= "
            <div class='swiper-slide product-col'>
                <div class='product-wrap product text-center'>
            ";
            if($big_product['price'] <=0 ){
                $product_price = 'Contact Seller';
                //$currency = '';
            }else{
                $product_price = number_format($big_product['price'], 2, '.', ',');
                } 
                $imageLink = (isset($request['display']) && !empty($request['display'])) ? $this->page->link.'/vensle-assets/backend/images/requests/'.$request['display']: "{$this->page->link}/backend/images/default.gif";
            $output .= "
             <figure class='product-media'>
                 <a href='{$this->page->link}/single-item/{$big_product['id']}/huioh43940-80'>
                <img src='".$imageLink."' alt='{$big_product['title']}'
                        width='216' height='243' />
                </a>
                <div class='product-action-vertical'>
                <a href='#' class='btn-product-icon btn-cart w-icon-cart'
                    title='Add to cart'></a>
                <a href='#' class='btn-product-icon btn-wishlist w-icon-heart'
                    title='Add to wishlist'></a>
                <a href='#' class='btn-product-icon btn-quickview w-icon-search'
                    title='Quickview'></a>
                <a href='#' class='btn-product-icon btn-compare w-icon-compare'
                    title='Add to Compare'></a>
            </div>
            </figure>
            ";
            $output .= "
            <div class='product-details'>
            <h4 class='product-name'><a href='{$this->page->link}/single-item/{$big_product['id']}/huioh43940-80'>{$big_product['title']}</a>
            </h4>
            <div class='ratings-container'>
                <div class='ratings-full'>
                    <span class='ratings' style='width: 60%;'></span>
                    <span class='tooltiptext tooltip-top'></span>
                </div>
                <a href='product-default.html' class='rating-reviews'>(3
                    reviews)</a>
            </div>
            <div class='product-price'>
                <ins class='new-price'>{$currency}{$product_price}</ins>
                ";
                $output.= ($big_product['item_condition'] == 1)
                ?"<span class='tip tip-success'>NEW</span>":"<span class='tip tip-hot'>USED</span>";
                $output .= "</div>
                </div>
            </div>
            </div>
            <!-- end of first loop -->
            ";

    }
}else{
    $output .= "There are currently no requested items"; 
}

    $output .= "</div>
<!--End of Catainer -->
</main>
<!-- End of Main -->";

return $output;