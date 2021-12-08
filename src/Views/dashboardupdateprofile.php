<?php

use Models\Functions;

$out = "
<div class='container container-fluid'>
            <div class='row' >
                <div class='col-md-5' style='background-color: lightgray'>
                  <div class='card card-profile'  >
                    <div class='card-avatar'>
                      <a href='javascript:;' style='border-radius: 20px'>
";
if($profile_img == '') {
    $out .= "<i class='fa fa-user-circle-o' style='position: relative; width: 100%; border-radius: 50% !important; left: 25%; top: 0px; width: 200px; height: 200px; overflow: hidden; background: #ccc; border: 3px solid #fff; margin-left:-29px;'></i>";
}else{
    $out .= "<img style='position: relative; width: 100%; border-radius: 50% !important; left: 25%; top: 0px; width: 200px; height: 200px; overflow: hidden; background: #ccc; border: 3px solid #fff;; margin-left:-29px' src='".Functions::getBackendAssetsLink()."/images/profile/{$profile_img}'>";
}
$out .= "
</a>
</div>
<div class='card-body'>
  <h6 class='card-category text-gray' style='text-align: center'> Email :".htmlentities($email)."</h6>
  <h4 class='card-title' style='text-align: center;'>Name:".htmlentities($full_name)."</h4>
  <p class='card-description' style='text-align: center'> Address:".htmlentities($address)."
  </p>
  <p style='text-align: center'>Phone:".htmlentities($phone)."</p>
  <form action='".Functions::getPageUrl("/backend/update-profile")."' method='post'>
      <center><button type='submit' name='delete_user' class='btn btn-primary btn-round'>Delete my account</button></center>
  </form>                      
</div>
</div>
</div>

<div class='col-md-6 dshPrfWrp' style='margin-left: 8px !important; background-color: white; '>
<div class='row prfImgRw' style='background-color: lightgray;' >
    <div class='col-md-15 prfInpWrp dataTables_filter' style='background-color: white; border-radius: 4px; margin-left: 4px'>
        {$errors}
        <h3><center>My Profile </center></h3>
        <form action='".Functions::getPageUrl("/backend/update-profile")."' method='post' enctype='multipart/form-data'>
        <div class='col-md-12'>
            <p>Full name:</p>
            <input class='m-l-0' type='text' name='full_name' value='".htmlentities($full_name)."'>
        </div>
        <div class='col-md-12'>
            <p>Email:</p>
            <input class='m-1-0' type='text' name='email' class='m-l-0' value='".htmlentities($email)."'>
        </div>
        <div class='col-md-12'>
            <p>Address:</p>
            <input class='m-l-0' type='text' name='address' value='".htmlentities($address)."'>
        </div>
        <div class='col-md-12'>
            <p>Phone:</p>
            <input class='m-l-0' type='text' name='phone' value='".htmlentities($phone)."'>
        </div>
        <div class='col-md-12'>
            <div class='row prFlRw'>
                <div class='col-md-4'>
                    Update Profile Picture here
                </div>
                <div class='col-md-8'>
                    <input type='file' name='profile'>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <!-- <input type='submit' class='btn btn-block btn-primary' name='submit' value='Update'> -->
            <button type='submit' name='submit' class='btn btn-block btn-primary'>Update</button>
        </div>
    </form>
</div>
</div>

</div>

</div>
";
$out .= include "src/Views/dashboardfooter.php";
$out .= " </div>

</div>
</div>
";

return $out;