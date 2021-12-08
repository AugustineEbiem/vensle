<?php 
$out = include "homenav.php";
$out .= "
<main class='main login-page'>
            <!-- Start of Page Header -->
            <div class='page-header'>
                <div class='container'>
                    <h1 class='page-title mb-0'>SIGN IN</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class='breadcrumb-nav'>
                <div class='container'>
                    <ul class='breadcrumb'>
                        <li><a href='{$this->page->link}'>Home</a></li>
                        <li>SIGN IN</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->
            <div class='page-content'>
                <div class='container'>
                    <div class='login-popup'>
                        <div class='tab tab-nav-boxed tab-nav-center tab-nav-underline'>
                            <label class='nav-link active text-primary' style='font-weight:bolder; font-size:20px'>Sign IN</label> 
                            {$message}
                            {$errors}
                            <form class='form-valide' role='form' action='' method='post' novalidate='novalidate'>
                                <div class='tab-content'>
                                    <div class='tab-pane active' id='sign-in'>
                                        <div class='form-group'>
                                            <label>Username or email address *</label>
                                            <input type='text' placeholder='Email:' class='form-control form-control-alternative valid' name='email' value='";
                                            if(isset($_COOKIE['loginId'])) {
                                              $out .= $_COOKIE['loginId'];
                                             } 
                                             $out .= "' required>
                                        </div>
                                        <div class='form-group mb-0'>
                                            <label>Password *</label>
                                            <input placeholder='Password:' class='form-control form-control-alternative valid' value='";
                                             if(isset($_COOKIE['loginPass'])) { 
                                                 $out.= $_COOKIE['loginPass']; 
                                            } 
                                             $out .= "' type='password' name='password' required>
                                        </div>
                                        <div class='form-checkbox d-flex align-items-center justify-content-between'>
                                            <input type='checkbox' class='custom-checkbox' id='remember1' name='remember1' required=''>
                                            <label for='remember1'>Remember me</label>
                                        </div>
                                        <button type='submit' class='btn btn-warning' name='submit' >Sign In</button>
                                    </div>
                                    <div class='row mt-3'>
                                        <div class='col-6'>
                                          <a href='{$this->page->link}/forgot-password' class='text-light'>
                                            <small>Forgot password?</small>
                                          </a>
                                        </div>
                                        <div class='col-6 text-right'>
                                          <a href='{$this->page->link}/register' class='text-light'>
                                            <small>Create new account</small>
                                          </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            </main>
";

$out .= include "homemodals.php";
$out .= include "homefooter.php";
return $out;