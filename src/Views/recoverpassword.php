<?php

use Models\Functions;
$email = isset($email) ? $email : "youremail@gmail.com";
$out = include "src/Views/homenav.php";
$out .= "
<main>
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
                  <h5 class='display-5'><small>Recover Password </small></h5>
                </div>
              </div>

              <div class='card-body px-lg-5 py-lg-5'>
                              
                ";
                $out .= $message;
                $out .= $errors;
               
                $out .= "<form class='form-valide' role='form' action='{$this->page->link}/recovery' method='post' novalidate='novalidate'>


                  <div class='form-group mb-3 focused'>
                    <div class='col-md-12 p-0'>
                    	<label>Enter Username/Email address</label>
                      <input type='email' placeholder='Email:{$email}' class='form-control form-control-alternative valid' name='email' value='' required='required'>
                    </div>
                  </div>
                  <div class='text-center'>
                    <input type='submit' class='btn btn-primary my-4' name='reset' value='Reset Password'>
                  </div>

                </form>
              </div>
            </div>
            <div class='row mt-3'>
              <div class='col-6 text-right'>
                <a href='{$this->page->link}/register' class='text-light'>
                  <small>Create new account</small>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

  </section>
</main>    
<hr class='m-0 p-0'>
";
$out .= include "homefooter.php";
$out .= include "homemodals.php";

return $out;