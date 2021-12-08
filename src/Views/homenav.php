<?php

use Models\Functions;
$keywords = isset($keywords) ? $keywords : "";

$out = "<!------------------------------------------ nav ------------------------------------>
<div class='page-wrapper'>
        <h1 class='d-none'>Vensle - Your Favourite online Market Place</h1>
        <!-- Start of Header -->
        <header class='header'>
            <div class='header-top'>
                <div class='container'>
                    <div class='header-left'>
                        <p class='welcome-msg'>Welcome to Vensle MarketPlace!</p>
                    </div>
                    <div class='header-right'>
                        
                        <span class='divider d-lg-show'></span>";
                        if (isset($_SESSION['user'])) {
                            $out .="
                            <div class='dropdown' style='width:150px !important'>
                                <a href='{$this->page->link}'>
                                    <i class='w-icon-envelop'></i>Messages</a>
                                <div class='dropdown-box' style='width:200px !important'>";
                                if($number_of_notification_messages == 0){
                                    $out.= "

                                    <h6><center>No new messages</center></h6>
                                    <hr>";
                                }
                                if($number_of_notification_messages > 0){
                                    $out.= "
                                    <label class='badge badge-round badge-info'>New{$number_of_notification_messages}</label>
                                ";
                                      foreach($notification_messages as $message){
                                          $out .= "
                                    <a href='{$this->page->link}/backend/read-message/{$message['request_id']}/290_oi%90%'>
                                        <b>{$message['sender_name']}</b>
                                        {$message['body']}
                                    </a>
                                    ";
                                      }
                                  }
                                      $out .= "
                                </div>
                            </div>
                            <!-- End of Dropdown Menu -->
                            <div class='dropdown'>
                                <a href='#' class='d-lg-show'>My Account</a>
                                <div class='dropdown-box'>
                                    <a href='{$this->page->link}/backend/update-profile'><i class='w-icon-account'></i>Profile</a>
                                    <a href='{$this->page->link}/backend'><i class='w-icon-dashboard'></i>Dashboard</a>
                                    <a href='{$this->page->link}/backend/message-inbox'><i class=' w-icon-envelop2'></i>Inbox</a>
                                    <a href='{$this->page->link}/backend/change-password'><i class='w-icon-cog'></i>Settings</a>
                                    <a href='{$this->page->link}/backend/logout'><i class='w-icon-logout'></i>Logout</a>
                                </div>

                             </div>
                            
                             ";
                         }else{
                            $out .="
                                <a href='{$this->page->link}/src/Views/ajax/login.php' class='d-lg-show login sign-in'><i
                                class='w-icon-account'></i>Sign In</a>
                                <span class='delimiter d-lg-show'>/</span>
                                <a href='{$this->page->link}/src/Views/ajax/login.php' class='ml-0 d-lg-show login register'>Register</a>";
                         } 
                         $out .="
                         <span class='divider d-lg-show'></span>
                         <div class='dropdown'>
                            <a href='#currency'>USD</a>
                            <div class='dropdown-box'>
                                <a href='#USD'>USD</a>
                                <a href='#EUR'>EUR</a>
                            </div>
                        </div>
                        <a></a>
                        <!-- End of DropDown Menu -->
                       
                    </div>
                </div>
            </div>
            <!-- End of Header Top -->
            <div class='header-middle'>
                <div class='container'>
                    <div class='header-left mr-md-4'>
                        <a href='#' class='mobile-menu-toggle  w-icon-hamburger' aria-label='menu-toggle'>
                        </a>
                        <a href='{$this->page->link}' class='logo ml-lg-0'>
                            <img src='{$this->page->link}/vensle-assets/images/logo2.png' alt='logo' width='144' height='45' />
                        </a>
                        <form action='{$this->page->link}/search' method='GET'
                            class='header-search hs-expanded hs-round d-none d-md-flex input-wrapper'>
                            <input type='hidden' name='no_filter' value='true'/>
                            <div class='select-box'>
                                <select id='category' name='category'>
                                    <option value=''>All Categories</option>";
                                     foreach($all_groups as $groups){
                                      $selected = $item_group_id == $groups['id'] ? 'selected':'';
                                      $out .= "<option {$selected} value='{$groups['id']}'>{$groups['name']}</option>";
                                  }

                      $out .= "
                                    
                                </select>
                            </div>
                            <input type='text' class='form-control' autocomplete='off' name='keywords' id='search' style='height: 38px; border-radius: 0px;' value='{$keywords}' placeholder='Search by product, description or state'
                                required />
                                <input type='hidden' class='form-control' autocomplete='off' name='no_filter' value=''
                                required />
                            <button class='btn btn-search' type='submit'><i class='w-icon-search'></i>
                            </button>
                        </form>
                    </div>
                    <div class='header-right ml-4'>";
                        if(Functions::checkIfUserIsLoggedIn()){
                            $out .= " 
                        <div class='header-call d-xs-show d-lg-flex align-items-center'>
                            <a href='tel:#' class='w-icon-call'></a>
                            <div class='call-info d-lg-show'>
                                <h4 class='chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0'>
                                    <a href='mailto:#' class='text-capitalize'>Live Chat </a> or :</h4>
                                <a href='tel:#' class='phone-number font-weight-bolder ls-50'>09035813821</a>
                            </div>
                        </div>
                        <a class='wishlist label-down link d-xs-show' href='{$this->page->link}/backend/upload-item'>
                            <i class=' w-icon-products'></i>
                            <span class='wishlist-label d-lg-show'>Upload Product</span>
                        </a>
                        <a class='compare label-down link d-xs-show' href='{$this->page->link}/guide/buy-sell'>
                            <i class='w-icon-tools'></i>
                            <span class='compare-label d-lg-show'>Sell/Buy Tutorial</span>
                        </a> 
                        <a class='compare label-down link d-xs-show' href='{$this->page->link}/backend/place-request'>
                            <i class='w-icon-cart'></i>
                            <span class='compare-label d-lg-show'>Place Request</span>
                        </a>";
                    }
                        else{
                            $out .="
                        <div class='header-call d-xs-show d-lg-flex align-items-center'>
                            <a href='tel:#' class='w-icon-call'></a>
                            <div class='call-info d-lg-show'>
                                <h4 class='chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0'>
                                    <a href='mailto:#' class='text-capitalize'>Live Chat </a> or :</h4>
                                <a href='tel:#' class='phone-number font-weight-bolder ls-50'>09035813821</a>
                            </div>
                        </div>
                        <a class='wishlist label-down link d-xs-show' href='javascript:void(0)' tabindex='0' data-toggle='popover' data-trigger='focus' title='You must be logged in to upload a product' data-content='Please login to place a request' data-original-title='Login Required'>
                            <i class=' w-icon-withdraw'></i>
                            <span class='wishlist-label d-lg-show'>Upload Product</span>
                        </a>
                        <a class='compare label-down link d-xs-show' href='{$this->page->link}/guide/buy-sell'>
                            <i class='w-icon-support'></i>
                            <span class='compare-label d-lg-show'>Sell/Buy Tutorial</span>
                        </a> 
                        <a class='compare label-down link d-xs-show' href='javascript:void(0)' tabindex='0' data-toggle='popover' data-trigger='focus' title='' data-content='Please login to place a request' data-original-title='Login Required'>
                            <i class='w-icon-orders'></i>
                            <span class='compare-label d-lg-show'>Place Request</span>
                        </a>";
                        
                        } 
                        
                        $out .="
                        
                    </div>
                </div>
            </div>
            <div class='header-bottom sticky-content fix-top sticky-header has-dropdown'>
                <div class='container'>
                    <div class='inner-wrap'>
                        <div class='header-left'>
                            <div class='dropdown category-dropdown has-border' data-visible='true'>
                                <a href='#' class='category-toggle text-dark' role='button' data-toggle='dropdown'
                                    aria-haspopup='true' aria-expanded='true' data-display='static'
                                    title='Browse Categories'>
                                    <i class='w-icon-category'></i>
                                    <span>Browse Categories</span>
                                </a>

                                <div class='dropdown-box'>
                                <ul class='menu vertical-menu category-menu'>";
                                foreach($all_groups as $groups){
                                    switch($groups['name']){
                                        case "Vehicle (Parts & Accessories)":
                                            $icon = "<i class='w-icon-truck'></i>";
                                        break;
                                        case "Fashion (Clothing, Jewelries & more...)":
                                            $icon = "<i class='w-icon-tshirt2'></i>";
                                        break;
                                        case "Electronics (Phones, Laptops & more...)":
                                            $icon = "<i class='w-icon-ios'></i>";
                                        break;
                                        case "Collectibles & Art":
                                            $icon = "<i class='w-icon-gift'></i>";
                                        break;
                                        case "Home & Garden":
                                            $icon = "<i class='w-icon-home'></i>";
                                        break;
                                        case "Sporting Goods":
                                            $icon = "<i class='w-icon-play'></i>";
                                        break;
                                        case "Kids & Baby (Kids' Clothing, Shoes & Accs)
                                        ":
                                            $icon = "<i class='w-icon-gamepad'></i>";
                                        break;
                                        case "General Business & Industrial":
                                            $icon = "<i class='w-icon-money'></i>";
                                        break;
                                        case "Musical":
                                            $icon = "<i class='w-icon-play'></i>";
                                        break;
                                        case "Food and Beverages":
                                            $icon = "<i class='w-icon-ice-cream'></i>";
                                        break;
                                        case "Books":
                                            $icon = "<i class='w-icon-ruby'></i>";
                                        break;
                                        case "Real Estate":
                                            $icon = "<i class='w-icon-home'></i>";
                                        break;
                                    }
                                    $out .= "
                                    <li>
                                    <a href='#{$groups['id']}'>
                                        {$icon}".strtok($groups['name'],"(")."
                                    </a>
                                </li>
                                    ";
                                }
                                   
                                    
                               $out .= "</ul>



                                </div>
                            </div>
                            <nav class='main-nav'>
                                <ul class='menu active-underline'>
                                    <li class='active'>
                                        <a href=''>Home</a>
                                    </li>
                                    <li>
                                        <a href=''>Shop</a>

                                                                            </li>
                                    
                                </ul>
                            </nav>
                        </div>
                        <div class='header-right'>
                            <a href='#' class='d-xl-show'><i class='w-icon-map-marker mr-1'></i>Track Order</a>
                            <a href='#'><i class='w-icon-sale'></i>Daily Deals</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End of Header -->
";

return $out;