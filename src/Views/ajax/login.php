
<div class="login-popup" style='max-width:500px;'>
    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline" >
        <ul class="nav nav-tabs text-uppercase" role="tablist">
            <li class="nav-item">
                <a href="#sign-in" class="nav-link active">Sign In</a>
            </li>
            <li class="nav-item">
                <a href="#sign-up" class="nav-link">Sign Up</a>
            </li>
        </ul>
        <div class="tab-content" >
            <div class="tab-pane active" id="sign-in">
                <div style='display: none;' class='emailPassErr alert alert-error alert-bg alert-block alert-inline' role='alert'>
                    
                    <p id='showErr'></p>
                    <button class="btn btn-link btn-close" aria-label="button">
                        <i class="close-icon"></i>
                    </button>
                </div>

                <p id='dFeedBack'></p>
                <form class="form-valide" role="form" id="homeLogIn" action="" method="post" novalidate="novalidate">
                    <div class="form-group">
                        <label>Email address *</label>
                        <input type="text" id="log_email" class="form-control" name="username" value=" <?php if(isset($_COOKIE['loginId'])) { 
                                             echo $_COOKIE['loginId']; 
                                        } ?>
                                         " id="username" required>
                    </div>
                    <div class="form-group mb-0">
                        <label>Password *</label>
                        <input type="password" id="log_pass" class="form-control" name="password" id="password" required>
                         
                    </div>
                    <p id='dFeedBack'></p>
                    <div class="form-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox"  name="rem" id=" customCheckLogin2" class="custom-checkbox">
                        <label for="remember">Remember me</label>
                        <a href="https://vensle.com/password-reset">Lost your password?</a>
                    </div>
                    <button type='button' id='sign_in' onclick="return do_login()" class='btn btn-primary my-4'>SIGN IN </button>
                    <center><img id="spinner_1" style="height:50px; width:inherit; padding:0px; display:none;" src="https://th.bing.com/th/id/R.03ef35f24c6e162a04af782a3f1ee227?rik=Dx7uXS1aCiulrQ&riu=http%3a%2f%2frekhta.org%2fContent%2fImages%2fprocessing.gif&ehk=TvwBM0DiwNmHU9uHV0BLiRa%2fG4p8tpMkZRqEBz6mEeE%3d&risl=&pid=ImgRaw&r=0"></center>
                </form>
                
            </div>


            <div class="tab-pane" id="sign-up">
                <div id='regShwErr' style='display: none;' class='alert alert-error alert-bg alert-block alert-inline' role='alert'>
                </div>
                <form class='form-valide' role='form'  method='post' onsubmit="return do_register()" >
                    <div class='tab-content'>
                        <div class='tab-pane active' id='sign-in'>
                       

                      <div class='card-body px-lg-6 py-lg-6' style='margin-top:-90px;'>
                          <div class='form-group'>
                            <div class='col-md-12'>
                              <input type='text' name='full_name' id='full_name' class='form-control form-control-alternative' value='' placeholder='Full name *' required>
                              </div>
                          </div>
                          <div class='form-group'>
                          <div class='col-md-12'>
                            <input type='text' name='business_name' id='biz_name' class='form-control form-control-alternative' value='' placeholder='Business Name (optional)' >
                            </div>
                        </div>

                        <div class='form-group'>
                          <div class='col-md-12'>
                            <input type='email' name='email' id='reg_email' class='form-control form-control-alternative' placeholder='Email *' value='' placeholder='Email *' required>
                          </div>
                        </div>
                        <div class='form-group'>
                          <div class='col-md-12'>
                            <input type='telephone' name='phone' id='reg_phone' class='form-control form-control-alternative' value='' placeholder='Phone *' required>
                          </div>
                        </div>
                        <div class='form-group focused'>
                          <div class='col-md-12'>
                            <input type='text' name='address' id='reg_address' class='form-control form-control-alternative valid' value='' placeholder='Address *' required>
                          </div>
                        </div>
                        <div class='form-group focused'>
                          <div class='col-md-12'>
                            <input type='password' name='password' id='reg_pass' class='form-control form-control-alternative valid' placeholder='Password *' required>
                          </div>
                        </div>
                        <div class='form-group'>
                          <div class='col-md-12'>
                            <input type='password' name='confirm_password' id='reg_cpass' class='form-control form-control-alternative' placeholder='Confirm Password *' required>
                          </div>
                        </div>
                            <button type='submit' class='btn btn-primary'  name='submit' >Create account</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
       
    </div>
</div>
<script type="text/javascript">
    function do_login(){

        event.preventDefault();
        var email=$("#log_email").val();
        var pass=$("#log_pass").val();
        if(email!="" && pass!=""){
            $("#spinner_1").css({"display":"block"});
            console.log("Email : "+email+", Password : "+pass);
            $.ajax({
                method: "POST",
                data: {
                  email: email,
                  password: pass
                },
                url: 'http://localhost/vensle/ajax/login'
                }).done(function(data){
                    $("#spinner_1").css({"display":"none"});
                    $('#dFeedBack').text(data);
                    myFeedbk = parseInt($('#dFeedBack').text());
                    console.log(myFeedbk);
                    if(myFeedbk == 1) {
                        location.reload();
                      }else {
                        $('#showErr').addClass("text-danger");
                        $('#showErr').html('<h4 class="alert-title"><i class="w-icon-exclamation-triangle"></i>Oh snap!</h4>'+"Email/Password wrong");
                        
                        $('.emailPassErr').slideDown();
                      }
                });
        }



    }

    function do_register(){
        event.preventDefault();
        var email=$("#reg_email").val();
        var pass=$("#reg_pass").val();
        var cpass=$("#reg_cpass").val();
        var name=$("#full_name").val();
        var biz=$("#biz_name").val();
        var phone=$("#reg_phone").val();
        var address=$("#reg_address").val();

        authErr = [ ];


        if(pass == ""){
          authErr.push("<p>Password can't be blank</p>");
          $('#reg_pass').addClass("text-danger");
        }else {
          $('#reg_pass').removeClass("text-danger");
          if(pass != cpass) {
            authErr.push("<p>Both passwords do not match</p>");
            $('#reg_pass').addClass("text-danger");
            $('#reg_cpass').addClass("text-danger");
          }else {
            $('#reg_pass').removeClass("text-danger");
            $('#reg_cpass').removeClass("text-danger");
          }
        }

        if(authErr == "") {
            $.ajax({
              method: 'POST',
              data: {
                fullName : name,
                busName : biz, 
                regEmail : email,
                phone : phone,
                address : address,
                regPass : pass, 
                regPassAgn : cpass,
                submit: 'submit'
              },
              url: 'http://localhost/vensle/ajax/register'
            }).done(function(data) {
                console.log(data)
                
                if(data == 3) {
                    authErr.push("<p>That email is in use. Please try another one</p>");
                    $('#regEml').addClass("text-danger");
                    $('#regShwErr').html('<h4 class="alert-title"><i class="w-icon-exclamation-triangle"></i>Oh snap!</h4>'+authErr);
                    $('#regShwErr').slideDown();
                }else {
                    authErr == "";
                    $('#regEml').removeClass("text-danger");
                }

                if(data == 2) {
                    authErr.push("<p>Something went wrong please try again");
                    $('#regShwErr').html('<h4 class="alert-title"><i class="w-icon-exclamation-triangle"></i>Oh snap!</h4>'+authErr);
                    $('#regShwErr').slideDown();
                }

                if(data == 1) {
                  locatn = document.location.origin;
                  window.location = locatn + '/login';
                }       

          });
        }else{
            $('#regShwErr').html('<h4 class="alert-title"><i class="w-icon-exclamation-triangle"></i>Oh snap!</h4>Make the correction and try submitting again.'+authErr);
            $('#regShwErr').slideDown();
        }



    }

    do_login();

   
</script>