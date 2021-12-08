<?php 
use Models\Functions;
      $errors = Functions::getFormErrors($errors);

$out = "{$errors}
<!-- Start Page Content -->
                <div class='container-fluid'>
                    <form class='form-valide' action='' method='post'>
                        <div class='row justify-content-center'>
                            <div class='col-lg-6'>

                                    <div class='card'>
                                        <div class='card-body'>
                                             <div class='row card-content'>
                                                <div class='col-lg-12'>
                                                    <input type='password' class='form-control input-default' name='old_password' placeholder='Old Password*'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card'>
                                        <div class='card-body'>
                                             <div class='row card-content'>
                                                <div class='col-lg-12'>
                                                    <input type='password' class='form-control input-default' name='new_password' placeholder='New Password*'>
                                                </div>
                                                <div class='col-lg-12 m-t-20'>
                                                    <input type='password' class='form-control input-default' name='new_password_again' placeholder='New Password again*'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class='row justify-content-center'>
                           <div class='col-6'>
                                <input type='submit' class='btn btn-primary btn-block' name='submit' value='Change Password'>
                           </div>
                       </div>
                    </form>
                </div>
        </div>

    </div>
    <!-- End Wrapper -->
";
$out .= include "src/Views/dashboardfooter.php";
return $out;