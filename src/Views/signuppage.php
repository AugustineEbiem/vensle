<?php
$out = include "homenav.php";
$out .= "
          <main class='main login-page'>
            <!-- Start of Page Header -->
            <div class='page-header'>
                <div class='container'>
                    <h1 class='page-title mb-0'>SIGN UP</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class='breadcrumb-nav'>
                <div class='container'>
                    <ul class='breadcrumb'>
                        <li><a href='{$this->page->link}'>Home</a></li>
                        <li>register</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->
            <div class='page-content'>
                <div class='container row'>
                    <div class='login-popup col-md-12'>
                        <div class='tab tab-nav-boxed tab-nav-center tab-nav-underline'>
                            <label class='nav-link active text-primary' style='font-weight:bolder; font-size:20px'>Sign UP</label> 
                            {$message}
                            {$errors}
                            <form class='form-valide' role='form' action='' method='post' novalidate='novalidate'>
                                <div class='tab-content'>
                                    <div class='tab-pane active' id='sign-in'>
                                    <div class='card-header bg-white pb-1 mb-2 pt-0 mt-0'>
                                  </div>
      
                                  <div class='card-body px-lg-6 py-lg-6'>
                                      <div class='form-group'>
                                        <div class='col-md-12'>
                                          <input type='text' name='full_name' class='form-control form-control-alternative' value='".htmlentities($full_name)."' placeholder='Full name *' required>

                                          </div>
                                      </div>
                                      <div class='form-group'>
                                      <div class='col-md-12'>
                                        <input type='text' name='business_name' class='form-control form-control-alternative' value='". htmlentities($business_name)."' placeholder='Business Name (optional)' >
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                      <div class='col-md-12'>
                                        <input type='text' name='email' class='form-control form-control-alternative' placeholder='Email *' value='".htmlentities($email)."' placeholder='Email *' required>
                                      </div>
                                    </div>
                                    <div class='form-group'>
                                      <div class='col-md-12'>
                                        <input type='telephone' name='phone' class='form-control form-control-alternative' value='".htmlentities($phone)."' placeholder='Phone *' required>
                                      </div>
                                    </div>
                                    <div class='form-group focused'>
                                      <div class='col-md-12'>
                                        <input type='text' name='address' class='form-control form-control-alternative valid' value='".htmlentities($address)."' placeholder='Address *' required>
                                      </div>
                                    </div>
                                    <div class='form-group focused'>
                                      <div class='col-md-12'>
                                        <input type='password' name='password' class='form-control form-control-alternative valid' placeholder='Password *' required>
                                      </div>
                                    </div>
                                    <div class='form-group'>
                                      <div class='col-md-12'>
                                        <input type='password' name='confirm_password' class='form-control form-control-alternative' placeholder='Confirm Password *' required>
                                      </div>
                                    </div>


                                        
                                        <button type='submit' class='btn btn-primary' name='submit' >Create account</button>
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
          </main>";

$out .= include "homefooter.php";
$out .= include "homemodals.php";

return $out;