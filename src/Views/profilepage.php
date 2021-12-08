<?php
use Models\Functions;
$currency = Functions::getGeoInformation("currency");


$out = include "src/Views/homenav.php";
$out .="
    <nav class='breadcrumb-nav'>
        <div class='container'>
            <ul class='breadcrumb bb-no'>
                <li><a href='demo1.html'>Home</a></li>
                <li><a href='#'>Vendor</a></li>
                <li><a href='#'>{$vendor}</a></li>
                <li>Profile Page</li>
            </ul>
        </div>
    </nav>
    <div class='page-content mb-8'>
                <div class='container'>
                    <div class='store store-wcfm-banner'>
                        <figure class='store-media' >
                            <img src='{$this->page->link}/vensle-assets/images/test.jpg' alt='Vendor' width='1240' height='460'
                                style='background-color: inherit;' />
                        </figure>
                        <div class='store-content'>
                            <div class='store-content-left mr-auto'>
                                <div class='personal-info'>
                                    <figure class='seller-brand'>
                                        <img src='{$this->page->link}/vensle-assets/V11/images/vendor/wcfm/avatar.png' alt='Brand' width='100'
                                            height='100' />
                                    </figure>
                                    <div class='ratings-container'>
                                        <div class='ratings-full'>
                                            <span class='ratings' style='width: 100%;'></span>
                                            <span class='tooltiptext tooltip-top'></span>
                                        </div>
                                    </div>
                                </div>
                                <div class='address-info'>
                                    <h4 class='store-title'>{$vendor}</h4>
                                    <ul class='seller-info-list list-style-none'>
                                        <li class='store-address'>
                                            <i class='w-icon-map-marker'></i>
                                            {$user['address']}
                                        </li>
                                        <li class='store-phone'>
                                            <a href='tel:{$user['phone']}'>
                                                <i class='w-icon-phone'></i>
                                                {$user['phone']}
                                            </a>
                                        </li>
                                        <li class='store-email'>
                                            <a href='email:{$user['email']}'>
                                                <i class='far fa-envelope'></i>
                                                {$user['email']}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class='store-content-right'>
                                <div class='btn btn-white btn-rounded btn-icon-left btn-inquiry'><i
                                        class='w-icon-comments-solid'></i>Chat Seller</div>
                                <div class='social-icons social-icons-colored border-thin'>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Store WCMP Banner -->

                    <div class='row gutter-lg'>
                        <aside class='sidebar left-sidebar vendor-sidebar sticky-sidebar-wrapper sidebar-fixed'>
                            <!-- Start of Sidebar Overlay -->
                            <div class='sidebar-overlay'></div>
                            <a class='sidebar-close' href='#'><i class='close-icon'></i></a>
                            <a href='#' class='sidebar-toggle'><i class='w-icon-angle-right'></i></a>
                            <div class='sidebar-content'>
                                <div class='sticky-sidebar'>
                                    
                                    <!-- End of Widget -->
                                    <div class='widget widget-collapsible widget-location'>
                                        <h3 class='widget-title'><span>Store Location</span></h3>
                                        <div class='widget-body'>
                                            <div class='google-map' id='googlemaps'></div>
                                        </div>
                                    </div>
                                    
                                    <!-- End of Widget -->
                                </div>
                            </div>
                        </aside>
                        <!-- End of Sidebar -->

                        <div class='main-content'>
                            <div class='tab tab-nav-underline tab-nav-boxed tab-vendor-wcfm'>
                                <ul class='nav nav-tabs'>
                                    <li class='nav-item'>
                                        <a href='#tab-1' class='nav-link active'>Active Products <label class='product-label label-new'>{$number_of_users_products}</label> </a>
                                    </li>
                                    <li class='nav-item'>
                                        <a href='#tab-2' class='nav-link'>Sold <label class='product-label label-new'>";
                                       
                                        $sold = (!empty($sold_items)) ?  count($sold_items) : 0 ;

                                        $out .=" {$sold}</label></a>
                                    </li>
                                   
                                </ul>
                                <div class='tab-content'>
                                    <div class='tab-pane active' id='tab-1'>
                                        <nav class='toolbox sticky-toolbox sticky-content fix-top'>
                                            <div class='toolbox-left'>
                                                
                                            </div>
                                            <div class='toolbox-right'>
                                                <div class='toolbox-item toolbox-sort select-box text-dark'>
                                                    <label>Sort By :</label>
                                                    <select name='orderby' class='form-control'>
                                                        <option value='default' selected='selected'>Default sorting
                                                        </option>
                                                        <option value='popularity'>Sort by popularity</option>
                                                        <option value='rating'>Sort by average rating</option>
                                                        <option value='date'>Sort by latest</option>
                                                        <option value='price-low'>Sort by pric: low to high</option>
                                                        <option value='price-high'>Sort by price: high to low</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </nav>
                                        <div class='product-wrapper row cols-md-3 cols-sm-2 cols-2'>
                                        ";
                                        foreach ($users_products as $product) {
                                        
                                        $out.="<div class='product-wrap'>
                                                <div class='product product-simple text-center'>
                                                    <figure class='product-media'>
                                                        <a href='{$this->page->link}/single-item/{$product['id']}/huioh43940-80'>
                                                        ";
                                                    $all_product_images = Functions::getProductImages($product['id']);
                                                        foreach($all_product_images as $product_image){
                                                            $out .= "
                                                            <img src='{$this->page->link}/vensle-assets/backend/images/uploads/{$product['id']}/{$product_image['id']}.{$product_image['ext']}' alt='alt='{$product['title']}'
                                                               style='width:300px !important; height:338px !important; object-fit:contain !important' />
                                                                ";
                                                                break;
                                                        }
                                                        $out .= "
                                                        </a>
                                                        <div class='product-action-vertical'>
                                                            <a href='#'
                                                                class='btn-product-icon btn-wishlist w-icon-heart'
                                                                title='Add to wishlist'></a>
                                                            <a href='#'
                                                                class='btn-product-icon btn-compare w-icon-compare'
                                                                title='Add to Compare'></a>
                                                        </div>
                                                        <div class='product-action'>
                                                        <a href='{$this->page->link}/single-item/{$product['id']}/huioh43940-80' class='d-lg-show btn-product' title='Quick View'>View Details</a>
                                                        </div>
                                                    </figure>
                                                    <div class='product-details'>
                                                        <h4 class='product-name'><a href=''>{$product['title']}</a></h4>
                                                        <div class='ratings-container'>
                                                            <div class='ratings-full'>
                                                                <span class='ratings' style='width: 60%;'></span>
                                                                <span class='tooltiptext tooltip-top'></span>
                                                            </div>
                                                            <a href='product-default.html' class='rating-reviews'>(3
                                                                reviews)</a>
                                                        </div>
                                                        <div class='product-pa-wrapper'>
                                                            <div class='product-price'>{$currency}".number_format($product['price'], 2, '.', ',')."

                                                            </div>
                                                            <div class='product-action'>
                                                                <a href='#'
                                                                    class='btn-cart btn-product btn btn-icon-right btn-link btn-underline'>";
                                                            $out .= $product['item_condition'] == 1 ? '<span class=\'tip tip-new\'>NEW<span>':'<span class=\'tip tip-hot\'>USED</span>';
                                                            $out .= "</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";
                                        }
                                        $out .="
                                            
                                        </div>
                                    </div>
                                    <div class='tab-pane' id='tab-2'>
                                        <p class='mb-4'><strong>L</strong>orem ipsum dolor sit amet, consectetur
                                            adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Venenatis tellus in metus vulputate eu scelerisque felis. Vel
                                            pretium lectus quam id leo in vitae turpis massa. Nunc id cursus
                                            metus aliquam. Libero id faucibus nisl tincidunt eget. Aliquam
                                            id diam maecenas ultricies mi eget mauris.</p>
                                        <p><strong>L</strong>orem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt tellus in metus vulputate eu scelerisque
                                            felis. Vel pretium lectus quam id leo. id faucibus nisl tincidunt eget.
                                            Aliquam id diam maecenas ultricies mi eget mauris. ut labore et dolore magna
                                            aliqua. Venenatis.</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- End of Main Content -->
                    </div>
                </div>
            </div>
    
";

$remove_jquery = false;
$out .= include "homefooter.php";
return $out;