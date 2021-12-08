<?php 

$out = include "src/Views/homenav.php";
$out .= "<main>
<section class='section section-shaped'>

    <div class='shape shape-style-1 bg-gradient-default'>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class='container'>

      <div class='row justify-content-center pb-5' style='z-index: 2; position: relative;'>
        <div class='col-lg-5'>
          <div class='card bg-secondary shadow border-0 bg-white'>

            <div class='card-header bg-white'>
              <div class='text-muted text-center mb-3'>
                <h3 class='display-5'><small style='font-family: sans-serif;'>Reset password</small></h3>
              </div>
            </div>

            <div class='card-body px-lg-5 py-lg-5'>";
        $out .= $message;
        $out .= $errors;
        if($reset == true) {
            $out .= "
            <form class='form-valide' role='form' action='' name='update' method='POST'>
            <div class='form-group mb-3 focused'>
              <div class='col-md-12 p-0'>
                <input type='password' placeholder='New Password:' class='form-control form-control-alternative valid' name='new_pass' id='user_password' required> 
              </div>
            </div>

            <div class='form-group focused'>
              <div class='col-md-12 p-0'>
                <input placeholder='Confirm Password:' class='form-control form-control-alternative valid' type='password' name='new_pass_c' id='confirm_password' required>
              </div>
            </div>
            <div class='text-center'>
              <input type='submit' class='btn btn-primary my-4' name='reset' value='Reset Password'>
            </div>
          </form>
            
            ";
        }else{
            $out .= "
            <div class='row'>
            <div class='col-6 p-0'>
              <a href='{$this->page->link}/recovery' class='text-dark'>
                Forgot password?
              </a>
            </div>
            <div class='col-6 text-right p-0'>
              <a href='{$this->page->link}/register' class='text-light text-dark'>
                Create new account
              </a>
            </div>
          </div>
            ";
        }
        $out .= " </div>
        </div>
        <!--<div class='row mt-3'>
          <div class='col-6'>
            <a href='{$this->page->link}/recovery' class='text-light'>
              <small>Forgot password?</small>
            </a>
          </div>
          <div class='col-6 text-right'>
            <a href='{$this->page->link}/register' class='text-light'>
              <small>Create new account</small>
            </a>
          </div>
        </div>-->
      </div>
    </div>
  </div>

</section>
</main>    
<hr class='m-0 p-0'>";
$out .= include "homefooter.php";
$out .= include "homemodals.php";
return $out;