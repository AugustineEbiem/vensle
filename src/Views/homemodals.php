<?php
$output = "
<div class='modal fade' id='r0101'>
      <div class='modal-dialog mt-1'>
        <div class='modal-content'>
          <div class='example-wrap mb-0'>
              <div class='nav-tabs-horizontal nav-tabs-inverse' data-plugin='tabs'>
                    <ul class='nav nav-tabs' role='tablist'>
                      <li class='nav-item' role='presentation'>
                        <a class='nav-link active' data-toggle='tab' href='#exampleTabsInverseOne' aria-controls='exampleTabsInverseOne' role='tab'>
                          LOGIN
                        </a>
                      </li>
                      <li class='nav-item' role='presentation'>
                        <a class='nav-link' data-toggle='tab' href='#exampleTabsInverseTwo' aria-controls='exampleTabsInverseTwo' role='tab'>
                          REGISTER
                        </a>
                      </li>
                    </ul>
                    <div class='tab-content p-20'>
                      <div class='tab-pane active' id='exampleTabsInverseOne' role='tabpanel'>
                        <div class='card bg-secondary shadow border-0 bg-white'>
                          <div class='card-header bg-white pb-1 mb-2 pt-0 mt-0'>
                              <div class='text-muted text-center mb-1'>
                                <h1><small>Please Sign In</small></h1>
                              </div>
                              <div class='emailPassErr'>
                                      <p id='showErr'></p>
                                    </div>
                                    <p id='dFeedBack'></p>
                          </div>

                          <div class='card-body px-lg-5 py-lg-5'>
                            <form class='form-valide' role='form' id='homeLogIn' action='' method='post' novalidate='novalidate'>
                                <div class='form-group mb-3 focused'>
                                  <div class='col-md-12 p-0'>
                                  
                                    <input type='text' id='log_email' placeholder='Email:' class='form-control form-control-alternative valid' name='email' value='";
                                     if(isset($_COOKIE['loginId'])) { 
                                         $output.= $_COOKIE['loginId']; 
                                    } 
                                     
                                     $output .= "'>

                                  </div>
                                </div>

                                <div class='form-group focused'>
                                  <div class='col-md-12 p-0'>
                                  
                                    <input placeholder='Password:' id='log_pass' class='form-control form-control-alternative valid' type='password' name='password' value='";
                                    
                                    if(isset($_COOKIE['loginPass'])) { 
                                        $output.= $_COOKIE['loginPass']; 
                                    } 
                                    
                                    $output.= "'>

                                       <!--<div class='emailPassErr'>
                                      <p id='showErr'></p>
                                    </div>
                                    <p id='dFeedBack'></p>
                                  <input type='hidden' value='' id='dFeedBack'> -->

                                  </div>
                                </div>

                                <div class='custom-control custom-control-alternative custom-checkbox'>
                                  <input class='custom-control-input' name='rem' id=' customCheckLogin2' type='checkbox'>
                                  <label class='custom-control-label' for=' customCheckLogin2'>
                                    <span>Remember me</span>
                                  </label>
                                </div>

                                <div class='text-center'>
                                  <button type='submit' id='sign_in' class='btn btn-primary my-4'>SIGN IN</button>
                                </div>
                            </form>
                            <div class='row text-primary'>
                              <a href='{$this->page->link}/recovery'>Forgot Password ?</a>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class='tab-pane' id='exampleTabsInverseTwo' role='tabpanel'>
                        <div class='card bg-secondary shadow border-0 bg-white'>
                          <div class='card-body px-lg-6 py-lg-6'>
                            <form class='form-valide' action='' method='post' role='form' novalidate='novalidate'>
                                <div class='card-header bg-white pb-1 mb-2 pt-0 mt-0'>
                                  <div class='text-muted text-center mb-1'>
                                  <h1><small>Sign up with credentials</small></h1>
                                  </div>
                                </div>
                                <div class='card-body px-lg-6 py-lg-6'>
                                      <div class='form-group'>
                                        <div class='col-md-12'>
                                          
                                          <div id='regShwErr' style='' class='emailPassErr'>
                                          </div>
                                          <input type='text' id='regFullName' name='full_name' class='form-control form-control-alternative' value='' placeholder='Full name *' required>

                                          </div>
                                      </div>
                                      <div class='form-group'>
                                        <div class='col-md-12'>
                                        
                                          <input type='text' id='regBusName' name='business_name' class='form-control form-control-alternative' value='' placeholder='Business Name (optional)'>

                                        </div>
                                      </div>
                                      <div class='form-group'>
                                        <div class='col-md-12'>
                                        
                                          <input type='text' id='regEml' name='email' class='form-control form-control-alternative' placeholder='Email *' value='' placeholder='Email *' required>

                                        </div>
                                      </div>
                                      <div class='form-group'>
                                        <div class='col-md-12'>
                                        
                                          <input type='text' id='regPhn' name='phone' class='form-control form-control-alternative' value='' placeholder='Phone *' required>

                                        </div>
                                      </div>
                                      <div class='form-group focused'>
                                        <div class='col-md-12'>
                                        
                                          <input type='text' id='regAdrs' name='address' class='form-control form-control-alternative valid' value='' placeholder='Address *' required>

                                        </div>
                                      </div>
                                      <div class='form-group focused'>
                                        <div class='col-md-12'>
                                        
                                          <input type='password' id='regPass' name='password' class='form-control form-control-alternative valid' placeholder='Password *' required>

                                        </div>
                                      </div>
                                      <div class='form-group'>
                                        <div class='col-md-12'>
                                        
                                          <input type='password' id='regPassAgn' name='confirm_password' class='form-control form-control-alternative' placeholder='Password again *' required>

                                        </div>
                                      </div>                  

                                      <div class='form-group row my-4'>
                                        <div class='col-12'>
                                          <div class='custom-control custom-control-alternative custom-checkbox'>
                                          <span>By clicking the <b>Create account</b> button, you agree to the <a href='./../policy/terms_conditions.php'>Privacy Policy and the Terms of use</a>
                                          </span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class='text-center'>
                                        <p id='regFeedBack'></p>
                                        <input type='submit' id='regSubmt' class='btn btn-primary mt-1' name='submit' value='Create account'>

                                      </div>                  
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
              </div>
          </div>
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal fade -->

    <!-- Contact Form Modal -->
    <div class='modal fade' id='r0202'>
      <div class='modal-dialog mt-1'>
      <div class='modal-content'>
        <div class='example-wrap mb-0'>
          <div class='row justify-content-center pb-5' style='z-index: 2; position: relative;'>
      

            <div class='card-header bg-white col-8'>
                  <div class='text-muted text-center mb-3'>
                    <h1 class=''><small>Contact Us</small></h1>
                  </div>
            </div>
            

            <div class='card-body px-lg-5 py-lg-5'>
              <form class='form-valide ftrCntForm' role='form' id='' action='' method='post' >
                
                <div id='contctSnt'></div>
                
                <div class='form-group mb-3 focused'>
                  <div class='col-md-12 p-0'>

                    <div id='contctErr1'>
                      <div class='message_box' style='margin: 10px 0px;'>
              
                      </div>
                    </div>
                    
                    <input type='text' name='name' id='contctName' placeholder='Name *' class='form-control form-control-alternative valid' aria-required='true' aria-describedby='val-email-error' aria-invalid='false' required>
                  </div>
                </div>

                <div class='form-group mb-3 focused'>
                  <div class='col-md-12 p-0'>
                    <input type='text' name='email' id='contctemail' placeholder='Email *' class='form-control form-control-alternative valid' aria-required='true' aria-describedby='val-email-error' aria-invalid='false' required>
                  </div>
                </div>

                <div class='form-group mb-3 focused'>
                  <div class='col-md-12 p-0'>
                    <select id='contctSub' name='subject' required>
                      <option value=''> --- Select option --- </option>
                      <option value='Complain'>Complain</option>
                      <option value='Abuse Report'>Report Abuse</option>
                      <option value='Need Help'>Need Help</option>
                      <option value='Question'>Question</option>
                    </select>
                  </div>
                </div>

                <div class='form-group focused'>
                  <div class='col-md-12 p-0'>
                  <textarea type='text' name='message' id='contctMsg' placeholder='Message *' class='form-control form-control-alternative valid' aria-required='true' required></textarea>
                  </div>
                </div>

                <div class='text-center'>
                  <button type='submit' name='contact_submission' id='subReprt' class='btn btn-primary btn-new my-4'>SEND</button>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Back</button>
                </div>
              </form>
            </div>
            </div>
        </div>
      </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal fade -->
    <script type='text/javascript' src='{$this->page->link}/vensle-assets/js/modals.js'>
</script>
";
//return $output;