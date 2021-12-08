<?php 

	namespace Controllers;
  use Psr\Http\Message\ServerRequestInterface;
  use Models\Functions;
  use Models\Notifications;
  use Models\Users;


class HomeController extends ZendResponse{
   public $page;
   protected $mail;
   protected $sendgrid;

	public function __construct(PageBuilder $page){
      $this->page = $page;
    }

    public function showHomePage(ServerRequestInterface $request,array $args):object{
      $keywords = "";
      $feedback = "";
      $item_group_id = "";
      if(isset($args['keywords']) && isset($args['category']) && $args['category'] != '') {
          $home_cat = (int)$args['category'];
          //if and else-if statements inherited from the old codebase
          if($home_cat == 1) {
            $keywords = 'Parts & Accessories- Motors';
          }elseif($home_cat == 2) {
            $keywords = 'Fashion';
          }elseif($home_cat == 3) {
            $keywords = 'Electronics';
          }elseif($home_cat == 4) {
            $keywords = 'Collectibles & Art';
          }elseif($home_cat == 5) {
            $keywords = 'Home & Garden';
          }elseif($home_cat == 6) {
            $keywords = 'Sporting Goods';
          }elseif($home_cat == 7) {
            $keywords = 'Kids & Baby';
          }elseif($home_cat == 8) {
            $keywords = 'General Business & Industrial';
          }elseif($home_cat == 9) {
            $keywords = 'Musical';
          }elseif($home_cat == 10) {
            $keywords = 'Food and Beverages';
          }elseif($home_cat == 11) {
            $keywords = 'Books';
          }elseif($home_cat == 12) {
            $keywords = 'Real Estate';
          }
      }else{
            $home_cat = false;
            // $keywords = htmlentities(trim($args['keywords']));
            $keywords = "";
          }      
          $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
          $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
          $all_groups = Functions::getGroups();
          if(Functions::checkIfUserIsLoggedIn()){
            $user_requests = Notifications::getUserRequests();
            $number_of_requests = count($user_requests);
            $notification_messages = Notifications::getNotificationMessages();
            $number_of_notification_messages = count($notification_messages);
          }
          $this->page->stylesheets = "<link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/css/demo1.min.css'>";
          $this->page->body = include "src/Views/homenav.php";
          $this->page->body .=  include "src/Views/homeslider.php";
          $names_of_big_groups = [
            [2, 'Fashion (Men & Women)', 'item_group', 6], 

            [5, 'Home & Garden', 'item_group', 6], 
            [12, 'Real Estate (Letting and Sales)', 'item_group', 6], 
            [10, 'Food and Beverages', 'item_group', 6], 
            [6, 'Sporting Goods', 'item_group', 6], 
            [4, 'Collectibles & Art', 'item_group', 6]
          ];
  
          $names_of_small_groups = [
            [7, 'Kids (Clothing, Shoes & Accs)', 'item_group', 12], 
            [3, 'Electronics (Phones, Computer)', 'item_group', 12], 
            [11, 'Books', 'item_group', 12], 
            [1, 'Vehicle (Parts & Accessories)', 'item_group', 12], 
            [8, 'Business and Industries', 'item_group', 12], 
            [9, 'Musical', 'item_group', 12]
          ];
  
          $cat_groups = [ 
            $names_of_big_groups[0][1]=>$names_of_small_groups[0][1], $names_of_big_groups[1][1]=>$names_of_small_groups[1][1], $names_of_big_groups[2][1]=>$names_of_small_groups[2][1], $names_of_big_groups[3][1]=>$names_of_small_groups[3][1], $names_of_big_groups[4][1]=>$names_of_small_groups[4][1], $names_of_big_groups[5][1]=>$names_of_small_groups[5][1] ];
          $currency = Functions::getGeoInformation("currency");
          $this->page->stylesheetsBefore = "<link rel='stylesheet' href='{$this->page->link}/vensle-assets/css/bootstrap.min.css'>";
          $this->page->body .=  include "src/Views/homecategories.php";
          $this->page->body .=  include "src/Views/homefooter.php";
          $this->page->scripts =  "<script src='{$this->page->link}/vensle-assets/V11/js/home.js'></script>";
       return $this->getResponse(); 
    }

    public function showSignInForm(){
      if(!isset($_SESSION['user'])){
        if(isset($_GET['reason'])){
          if($_GET['reason'] == "You need to be logged in to place an order"){
            $this->page->errors->addError("You need to be logged in to place an order. <br > Don't have an account ? <a href='{$this->page->link}/signup'> register </a> ");
          }
          if($_GET['reason'] == "You need to be logged in to access the user dashboard"){
            $this->page->errors->addError("You need to be logged in to access the user dashboard. <br > Don't have an account ? <a href='{$this->page->link}/signup'> register </a> ");
          }
          $this->page->errors->addError($_GET['reason']);
        }
        $this->page->stylesheets = "<link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/css/style.min.css'>";
        $this->page->title = "Login | Vensle.com";
        $this->page->metaDescription = "Login if you are already registered to upload an item, place a request chat a user and have the best experience on vensle.com";
        $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
        $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
        $all_groups = Functions::getGroups();
          if(Functions::checkIfUserIsLoggedIn()){
            $user_requests = Notifications::getUserRequests();
            $number_of_requests = count($user_requests);
            $notification_messages = Notifications::getNotificationMessages();
            $number_of_notification_messages = count($notification_messages);
          }
        $message = Functions::getResponseMessages();
        $errors = Functions::getFormErrors();
        $footer_custom_library = "";
        $this->page->body = include "src/Views/signinpage.php";
        return $this->getResponse();
      }else{
        $this->redirectTo("backend");
      }
  
    }


    public function signUserIn(){
      if(!isset($_SESSION['user'])){
        if(isset($_POST['submit'])){
          $required_fields = array("email", "password");
          Functions::checkIfParametersEmpty($required_fields);
          $password = $_POST["password"];
          $email = $_POST["email"];
          if(empty($errors)) {
            $logged_in = Functions::logUserIn($email, $password);
            if($logged_in) {
              $this->redirectTo("backend");
            } 
            else {
              $errors['login'] = 'email/Password wrong';
            }
          }
        }
        $this->page->stylesheets = "<link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/css/style.min.css'>";
        $this->page->title = "Login | Vensle.com";
        $this->page->metaDescription = "Login if you are already registered to upload an item, place a request chat a user and have the best experience on vensle.com";
        $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
        $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
        $all_groups = Functions::getGroups();
          if(Functions::checkIfUserIsLoggedIn()){
            $user_requests = Notifications::getUserRequests();
            $number_of_requests = count($user_requests);
            $notification_messages = Notifications::getNotificationMessages();
            $number_of_notification_messages = count($notification_messages);
          }
        $message = Functions::getResponseMessages();
        $errors = Functions::getFormErrors();
        $footer_custom_library = "";
        $this->page->body = include "src/Views/signinpage.php";
        return $this->getResponse();
      }else{
        Functions::redirectTo("backend");
      }
  
    }

    public function showSignUpForm(){
      if(!isset($_SESSION['user'])){
        $this->page->stylesheets = "<link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/css/style.min.css'>";
        $full_name = "";
        $business_name = "";
        $username = "";
        $first_name = "";
        $last_name = "";
        $email = "";
        $phone = "";
        $address = "";
        $this->page->title = "Register | Vensle.com";
        $this->page->metaDescription = "Please Register to have unlimited access to the features of vensle.com or Login if you are already registered";
        $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
        $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
        $all_groups = Functions::getGroups();
          if(Functions::checkIfUserIsLoggedIn()){
            $user_requests = Notifications::getUserRequests();
            $number_of_requests = count($user_requests);
            $notification_messages = Notifications::getNotificationMessages();
            $number_of_notification_messages = count($notification_messages);
          }
        $message = Functions::getResponseMessages();
        $errors = Functions::getFormErrors();
        $footer_custom_library = "";
        $this->page->body = include "src/Views/signuppage.php";
        return $this->getResponse();
      }else{
        $this->redirectTo("backend");
      }
  
    }
    public function showProfilePage(ServerRequestInterface $request,array $args){
      $bibchen = isset($args["bibchen"]) ? $args["bibchen"] : "NULL";

      if (isset($bibchen)) {
        $user_id = $bibchen;
        $this->page->title = "Vensle | Your Favourite Online shopping website";
        $this->page->stylesheets = "
        <link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/css/style.min.css'>
        <link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/vendor/photoswipe/photoswipe.min.css'>
        <link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/vendor/photoswipe/default-skin/default-skin.min.css'>";
        $this->page->scripts .= "
        <script src='{$this->page->link}/vensle-assets/V11/vendor/zoom/jquery.zoom.js'></script>
        <script src='{$this->page->link}/vensle-assets/V11/vendor/photoswipe/photoswipe.min.js'></script>
        <script src='{$this->page->link}/vensle-assets/V11/vendor/photoswipe/photoswipe-ui-default.min.js'></script>";
        $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
        $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
        $all_groups = Functions::getGroups();
        if(Functions::checkIfUserIsLoggedIn()){
          $user_requests = Notifications::getUserRequests();
          $number_of_requests = count($user_requests);
          $notification_messages = Notifications::getNotificationMessages();
          $number_of_notification_messages = count($notification_messages);
          $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
        }
        $user = Functions::getUserById($bibchen);
        $vendor = ($user['business_name'] == "") ? $user['full_name'] : $user['business_name'] ;
        $this->page->title = "Vensle.com - ".$vendor."'s Profile Page ";
        
        $numm = 0;
        $sold_items = Functions::getAllProducts('yes',false,false,$bibchen);
        $users_products = Functions::getAllProducts('no',false,false,$bibchen);
        if($users_products){
          $number_of_users_products = count($users_products);
        }else{
          $number_of_users_products = 0;
        }
        
        
        $this->page->body = include "src/Views/profilepage.php";

        return $this->getResponse();
      }
      else{
        $this->redirectTo("/");
      }
    }
    public function showProductView($request,$args){
      $bibchen = isset($args["bibchen"]) ? $args["bibchen"] : NULL;
      if(isset($bibchen)){
        $id = $bibchen;
        $logged_in = Functions::checkIfUserIsLoggedIn();
        $check_aprroved = true;
        $product = Functions::getProductDetailsById($id,$check_aprroved);
        if(!$product){
          $this->redirectTo("/");
        }else{
          if(!isset($_SESSION['recnt_ary'])) {
            $_SESSION['recnt_ary'] = [];
          }
          array_unshift($_SESSION['recnt_ary'], $product['id']);
          $uniq_recnt = array_unique($_SESSION['recnt_ary']);
          if(count($uniq_recnt) > 3) {
              $_SESSION['recnt_ary'] = $uniq_recnt = array_slice($uniq_recnt, 0, 4);
          }
          $user = Functions::getUserById($product['user_id']);
          $product_group = $product['item_group'];
          $product_category = $product['category'];
          if($logged_in){
            if(Functions::checkIfProductBelongsToUser($id) || Functions::checkIfUserIsAdmin()){
              $check_aprroved = false;
            }
          }
        }
            $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
            $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
            $all_groups = Functions::getGroups();
            

            $this->page->body = include "src/Views/ajax/product.php";
            return $this->getResponse();
      }else{
        $this->redirectTo("/");
      }
      
  
    }

    public function signUserUp(){
      if(!isset($_SESSION['user'])){
        if(isset($_POST['submit'])){
          $full_name      = $_POST["full_name"];
          $business_name  = $_POST["business_name"];
          $email          = $_POST["email"];
          $phone          = $_POST["phone"];
          $address        = $_POST["address"];
          $password       = $_POST["password"];
          $confirm_password = $_POST["confirm_password"];
          $required_fields = array("full_name", "password", "email", "phone", "address");
          Functions::checkIfParametersEmpty($required_fields);
          $fields_with_max_lengths = array("full_name" => 50, "password" => 50);
          Functions::validateMaxLengths($fields_with_max_lengths);

          if(Functions::checkIfEmailExists($email)) {
            $errors['used_email'] = "That email is in use. Please try another one";
          }
          if($password != "") {
            if($password !== $confirm_password) {
              $errors['match_pass'] = "Both passwords do not match";
            }
          }
      
          if(!empty($errors['used_email'])) {
            echo 3;
          }
          
          if(empty($errors)) {
            $hashed_password = Functions::encryptPassword($password);
            $user = new Users();
            $user->full_name = $full_name;
            $user->business_name = $business_name;
            $user->email = $email;
            $user->phone = $phone;
            $user->address = $address;
            $user->hashed_password = $hashed_password;
            $result = $user->save();
            if($result) {
              $_SESSION["message"] = "User created successfully please login";
              Functions::redirectTo("/backend");
            } else {
              $errors['register'] = 'Could not register please try again';    
            }
          }
        }
        $this->page->stylesheets = "<link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/css/style.min.css'>
        ";
        $full_name = "";
        $business_name = "";
        $username = "";
        $first_name = "";
        $last_name = "";
        $email = "";
        $phone = "";
        $address = "";
        $this->page->title = "Register | Vensle.com";
        $this->page->metaDescription = "Please Register to have unlimited access to the features of vensle.com or Login if you are already registered";
        $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
        $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
        $all_groups = Functions::getGroups();
          if(Functions::checkIfUserIsLoggedIn()){
            $user_requests = Notifications::getUserRequests();
            $number_of_requests = count($user_requests);
            $notification_messages = Notifications::getNotificationMessages();
            $number_of_notification_messages = count($notification_messages);
          }
        $message = Functions::getResponseMessages();
        $errors = Functions::getFormErrors();
        $footer_custom_library = "";
        $this->page->body = include "src/Views/signuppage.php";
        return $this->getResponse();
      }else{
        Functions::redirectTo("/backend");
      }
    }

    public function showProductPage($request,$args){
      $bibchen = isset($args["bibchen"]) ? $args["bibchen"] : NULL;
      if(isset($bibchen)){
        $id = $bibchen;
        $logged_in = Functions::checkIfUserIsLoggedIn();
        $check_aprroved = true;
        $product = Functions::getProductDetailsById($id,$check_aprroved);
        if(!$product){
          $this->redirectTo("/");
        }else{
          if(!isset($_SESSION['recnt_ary'])) {
            $_SESSION['recnt_ary'] = [];
          }
          array_unshift($_SESSION['recnt_ary'], $product['id']);
          $uniq_recnt = array_unique($_SESSION['recnt_ary']);
          if(count($uniq_recnt) > 3) {
              $_SESSION['recnt_ary'] = $uniq_recnt = array_slice($uniq_recnt, 0, 4);
          }
          $user = Functions::getUserById($product['user_id']);
          $product_group = $product['item_group'];
          $product_category = $product['category'];
          if($logged_in){
            if(Functions::checkIfProductBelongsToUser($id) || Functions::checkIfUserIsAdmin()){
              $check_aprroved = false;
            }
          }
        }
        $this->page->title = "Vensle | Your Favourite Online shopping website";
        $this->page->stylesheets = "
        <link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/css/style.min.css'>
        <link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/vendor/photoswipe/photoswipe.min.css'>
        <link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/vendor/photoswipe/default-skin/default-skin.min.css'>";

        $this->page->scripts .= "
        <script src='{$this->page->link}/vensle-assets/V11/vendor/zoom/jquery.zoom.js'></script>
        <script src='{$this->page->link}/vensle-assets/V11/vendor/photoswipe/photoswipe.min.js'></script>
        <script src='{$this->page->link}/vensle-assets/V11/vendor/photoswipe/photoswipe-ui-default.min.js'></script>";
            $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
            $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
            $all_groups = Functions::getGroups();
            if(Functions::checkIfUserIsLoggedIn()){
              $user_requests = Notifications::getUserRequests();
              $number_of_requests = count($user_requests);
              $notification_messages = Notifications::getNotificationMessages();
              $number_of_notification_messages = count($notification_messages);
            }

            $title = $product['title'];
            $similar = [];
            $tot_sug = 2;
            $lft = 2;
            $found = 0;
            if($lft > 0) {
              Functions::sugExact(false,$id,$product_group,$product_category,$title,$similar,$found,$lft,$tot_sug);
            }                                

            if($lft > 0) {
              Functions::sugRgExact(false,$id,$product_group,$product_category,$title,$similar,$found,$lft,$tot_sug);
            }                

            if($lft > 0) {
              Functions::titleSplit(false,$id,$product_group,$product_category,$title,$similar,$found,$lft,$tot_sug);
            }

            if($lft > 0) {
              Functions::sugExact(true,$id,$product_group,$product_category,$title,$similar,$found,$lft,$tot_sug);
            }                                

            if($lft > 0) {
              Functions::sugRgExact(true,$id,$product_group,$product_category,$title,$similar,$found,$lft,$tot_sug);
            }                

            if($lft > 0) {
              Functions::titleSplit(true,$id,$product_group,$product_category,$title,$similar,$found,$lft,$tot_sug);
            }
            $this->page->body = include "src/Views/productpage.php";
            return $this->getResponse();
      }else{
        $this->redirectTo("/");
      }
    }



    public function showPasswordRecovery(){
      if(Functions::checkIfUserIsLoggedIn()){
        Functions::redirectTo("/backend");
      }
      if(!isset($_SESSION['user'])){
        $this->page->stylesheets = "<link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/bootstrap.min.css'>
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/style.css'>
        <link type='text/css' rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/lightslider.css' />                  
  
        <!-- Custom CSS -->
        <link href='{$this->page->link}/vensle-assets/FrontEnd/admin_master/css/helper.css' rel='stylesheet'>
        <link href='{$this->page->link}/vensle-assets/FrontEnd/admin_master/css/style.css' rel='stylesheet'>        
  
        <!-- MiMain -->
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/main.css'>
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/design_system/css/main.css'>
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/admin_master/css/main.css' >
  
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/lib/jquery/jquery.min.js'></script>";
        $this->page->title = "Password Reset | Vensle.com";
        $this->page->metaDescription = "Reset your Password";
        $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
        $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
        $all_groups = Functions::getGroups();
          if(Functions::checkIfUserIsLoggedIn()){
            $user_requests = Notifications::getUserRequests();
            $number_of_requests = count($user_requests);
            $notification_messages = Notifications::getNotificationMessages();
            $number_of_notification_messages = count($notification_messages);
          }
        $message = Functions::getResponseMessages();
        $errors = Functions::getFormErrors();
        $footer_custom_library = "<script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/jquery.slimscroll.js'></script>
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/sidebarmenu.js'></script>
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/lib/sticky-kit-master/dist/sticky-kit.min.js'></script>
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/custom.min.js'></script>";
        $this->page->body = include "src/Views/recoverpassword.php";
        return $this->getResponse();
      }else{
        $this->redirectTo("backend");
      }
    }


    public function performPasswordRecovery(){
      if(Functions::checkIfUserIsLoggedIn()){
        Functions::redirectTo("/backend");
      }
      if(!isset($_SESSION['user'])){
        if(isset($_POST['reset'])){
          if(isset($_POST["email"]) && (!empty($_POST["email"]))){
            $email = $_POST["email"];
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$email) {
                $errors['invalid_email'] ="Invalid email address!";
              }
              else{
              $userExists = Functions::checkIfEmailExists($email); 
              if (!$userExists){
                $errors['no_email'] = "No Registered user is with this email address!";
                }
              }
              if(empty($errors)){
                $expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
                $expDate = date("Y-m-d H:i:s",$expFormat);
                $key = md5(2418*2+$email);
                $addKey = substr(md5(uniqid(rand(),1)),3,10);
                $key = $key . $addKey;
                // Insert Temp Table
                $savedTempPassword = Functions::saveTemporaryPassword($email,$key,$expDate);
                if($savedTempPassword){

                }
                $emailBody = include "src/Views/recoveryemailtemplate.php";
                $body = $emailBody; 
                $subject = "Password Recovery - Vensle.com";
                $email_to = $email;
                $fromserver = "noreply@Vensle.com"; 
                require("PHPMailer/PHPMailerAutoload.php");
                $mail = new \PHPMailer();
                $mail->IsSMTP();
                $mail->Host = "smtpout.secureserver.net"; // Enter your host here
                $mail->SMTPAuth = true;
                $mail->Username = "augustine@vensle.com"; // Enter your email here
                $mail->Password = "sYet!9U4+E5b%UV"; //Enter your password here
                $mail->Port = 80;
                $mail->IsHTML(true);
                $mail->From = "support@vensle.com";
                $mail->FromName = "Support@vensle.com";
                $mail->Sender = $fromserver; // indicates ReturnPath header
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->AddAddress($email_to);
                if(!$mail->send()){
                  $errors['not_sent'] = "Mailer Error: " . $mail->ErrorInfo;
                }
                else{
                  $_SESSION['message']='A Password reset link has been sent to :'.$email.'; link expires in 24 hours.';
                }
          };
        }
        }
        $this->page->stylesheets = "<link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/bootstrap.min.css'>
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/style.css'>
        <link type='text/css' rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/lightslider.css' />                  
  
        <!-- Custom CSS -->
        <link href='{$this->page->link}/vensle-assets/FrontEnd/admin_master/css/helper.css' rel='stylesheet'>
        <link href='{$this->page->link}/vensle-assets/FrontEnd/admin_master/css/style.css' rel='stylesheet'>        
  
        <!-- MiMain -->
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/main.css'>
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/design_system/css/main.css'>
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/admin_master/css/main.css' >
  
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/lib/jquery/jquery.min.js'></script>";
        $this->page->title = "Password Reset | Vensle.com";
        $this->page->metaDescription = "Reset your Password";
        $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
        $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
        $all_groups = Functions::getGroups();
          if(Functions::checkIfUserIsLoggedIn()){
            $user_requests = Notifications::getUserRequests();
            $number_of_requests = count($user_requests);
            $notification_messages = Notifications::getNotificationMessages();
            $number_of_notification_messages = count($notification_messages);
          }
        $message = Functions::getResponseMessages();
        $errors = Functions::getFormErrors();
        $footer_custom_library = "<script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/jquery.slimscroll.js'></script>
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/sidebarmenu.js'></script>
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/lib/sticky-kit-master/dist/sticky-kit.min.js'></script>
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/custom.min.js'></script>";
        $this->page->body = include "src/Views/recoverpassword.php";
        return $this->getResponse();
      }else{
        $this->redirectTo("backend");
      }
    }


    public function showPasswordReset(){
      if(Functions::checkIfUserIsLoggedIn()){
        Functions::redirectTo("/backend");
      }
      if(!isset($_SESSION['user'])){
        $reset = true;
        $this->page->stylesheets = "<link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/bootstrap.min.css'>
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/style.css'>
        <link type='text/css' rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/lightslider.css' />                  
  
        <!-- Custom CSS -->
        <link href='{$this->page->link}/vensle-assets/FrontEnd/admin_master/css/helper.css' rel='stylesheet'>
        <link href='{$this->page->link}/vensle-assets/FrontEnd/admin_master/css/style.css' rel='stylesheet'>        
  
        <!-- MiMain -->
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/front_templated/css/main.css'>
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/design_system/css/main.css'>
        <link rel='stylesheet' href='{$this->page->link}/vensle-assets/FrontEnd/admin_master/css/main.css' >
  
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/lib/jquery/jquery.min.js'></script>";
        $this->page->title = "Password Reset | Vensle.com";
        $this->page->metaDescription = "Password Recovery at vensle.com";
        $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
        $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
        $all_groups = Functions::getGroups();
          if(Functions::checkIfUserIsLoggedIn()){
            $user_requests = Notifications::getUserRequests();
            $number_of_requests = count($user_requests);
            $notification_messages = Notifications::getNotificationMessages();
            $number_of_notification_messages = count($notification_messages);
          }
        $message = Functions::getResponseMessages();
        $errors = Functions::getFormErrors();
        $footer_custom_library = "<script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/jquery.slimscroll.js'></script>
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/sidebarmenu.js'></script>
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/lib/sticky-kit-master/dist/sticky-kit.min.js'></script>
        <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/custom.min.js'></script>";
        $this->page->body = include "src/Views/resetpassword.php";
        return $this->getResponse();
      }else{
        $this->redirectTo("backend");
      }
    }


    public function performPasswordReset(){
      if(Functions::checkIfUserIsLoggedIn()){
        Functions::redirectTo("/backend");
      }
      if(!isset($_SESSION['user'])){
        $email = "";

        $reset = false;
        if (!isset($_POST['reset'])&& ($_GET["action"]=="reset") ) {
          if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) ){
            $key = $_GET["key"];
            $email = $_GET["email"];
            $curDate = date("Y-m-d H:i:s");
            $curDate = strtotime($curDate);
            $keyExists = Functions::checkIfResetKeyExists($key,$email);
            if(!$keyExists){
              $errors['invalid_link'] = "Invalid Link.";
            }
            elseif($keyExists){
              $expDate = $keyExists['expDate'];
              $expDate = strtotime($expDate);
              if ($expDate <= $curDate){
                $errors['expired_link'] = $curDate."The link is expired or deactivated. Reset your password.".$expDate;
              }else{
                $reset  = true;
              }
            }
            else{
              $reset = true;
            }
          }
        }
        else{
          $reset = true;
        }
        if (isset($_POST["reset"])) {
            $new_pass = $_POST['new_pass'];
            $new_pass_c = $_POST['new_pass_c'];
            $email = $_GET['email'];
            if($email != '') {
              $hashed_password = Functions::encryptPassword($_POST["new_pass"]);
              if($hashed_password) {
                $passwordUpdated = Functions::updatePasswordRecovery($hashed_password,$email);
                if($passwordUpdated){
                  $deletedTempPassword = Functions::deleteTemporaryPassword($email);
                  if($deletedTempPassword){
                    $_SESSION["message"] = "Password updated successfully";
                    return Functions::redirectTo("/login");
                  }
                } 
                else {
                  $errors['change_password'] = 'Something went wrong, please try again';        
                }

              }    
            }
          }
      }else{
        Functions::redirectTo("/backend");
      }
    }



    public function showBuySellTutorial(){
      $this->page->title = "Sell and Buy Guide | Vensle.com";
      $this->page->metaDescription = "This is a brief tutorial of how to use the vensle.com website. It contains explanations of the features that might confuse the average user";
      $this->page->stylesheets = "<link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/css/style.min.css'>";
      $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
      $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
      $all_groups = Functions::getGroups();
        if(Functions::checkIfUserIsLoggedIn()){
          $user_requests = Notifications::getUserRequests();
          $number_of_requests = count($user_requests);
          $notification_messages = Notifications::getNotificationMessages();
          $number_of_notification_messages = count($notification_messages);
          
        }
      $message = Functions::getResponseMessages();
      $errors = Functions::getFormErrors();
      $footer_custom_library = "";
      $this->page->body = include "src/Views/buysellpage.php";
      return $this->getResponse();
     
    }


    public function showFaq(){
      $this->page->title = "Frequently Asked Questions (FAQ) | Vensle.com";
      $this->page->metaDescription = "The frequently asked questions are lists of answers to the most commonly asked questions";
      $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
      $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
      $all_groups = Functions::getGroups();
        if(Functions::checkIfUserIsLoggedIn()){
          $user_requests = Notifications::getUserRequests();
          $number_of_requests = count($user_requests);
          $notification_messages = Notifications::getNotificationMessages();
          $number_of_notification_messages = count($notification_messages);
        }
      $message = Functions::getResponseMessages();
      $errors = Functions::getFormErrors();
      $footer_custom_library = "";
      $this->page->body = include "src/Views/faqpage.php";
      return $this->getResponse();
      
    }


    public function showTerms(){
      $this->page->title = "Terms and Conditions | Vensle.com";
      $this->page->metaDescription = "The Terms and Conditions of the use of the vensle.com website";
      $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
      $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
      $all_groups = Functions::getGroups();
        if(Functions::checkIfUserIsLoggedIn()){
          $user_requests = Notifications::getUserRequests();
          $number_of_requests = count($user_requests);
          $notification_messages = Notifications::getNotificationMessages();
          $number_of_notification_messages = count($notification_messages);
        }
      $message = Functions::getResponseMessages();
      $errors = Functions::getFormErrors();
      $footer_custom_library = "<script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/jquery.slimscroll.js'></script>
      <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/sidebarmenu.js'></script>
      <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/lib/sticky-kit-master/dist/sticky-kit.min.js'></script>
      <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/custom.min.js'></script>";
      $this->page->body = include "src/Views/termspage.php";
      return $this->getResponse();
    }


    public function showPrivacyPolicy(){
      $this->page->title = "Privacy Policy | Vensle.com";
      $this->page->metaDescription = "The Privacy Policy of the use of the vensle.com website";
      $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
      $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
      $all_groups = Functions::getGroups();
        if(Functions::checkIfUserIsLoggedIn()){
          $user_requests = Notifications::getUserRequests();
          $number_of_requests = count($user_requests);
          $notification_messages = Notifications::getNotificationMessages();
          $number_of_notification_messages = count($notification_messages);
        }
      $message = Functions::getResponseMessages();
      $errors = Functions::getFormErrors();
      $footer_custom_library = "<script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/jquery.slimscroll.js'></script>
      <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/sidebarmenu.js'></script>
      <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/lib/sticky-kit-master/dist/sticky-kit.min.js'></script>
      <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/custom.min.js'></script>";
      $this->page->body = include "src/Views/privacypolicypage.php";
      return $this->getResponse();
    }


    public function showProductListing(){
      $this->page->title = "Product Listing Policy | Vensle.com";
      $this->page->metaDescription = "The Product Listing Policy of the vensle.com website";
      $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
      $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
      $all_groups = Functions::getGroups();
        if(Functions::checkIfUserIsLoggedIn()){
          $user_requests = Notifications::getUserRequests();
          $number_of_requests = count($user_requests);
          $notification_messages = Notifications::getNotificationMessages();
          $number_of_notification_messages = count($notification_messages);
        }
      $message = Functions::getResponseMessages();
      $errors = Functions::getFormErrors();
      $footer_custom_library = "<script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/jquery.slimscroll.js'></script>
      <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/sidebarmenu.js'></script>
      <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/lib/sticky-kit-master/dist/sticky-kit.min.js'></script>
      <script src='{$this->page->link}/vensle-assets/FrontEnd/admin_master/js/custom.min.js'></script>";
      $this->page->body = include "src/Views/productlistingpolicypage.php";
      return $this->getResponse();
    }


    public function showContactForm(){
      $this->page->title = "Contact | Vensle.com";
      $this->page->metaDescription = "Please send us a message if you have any questions or if you are having any difficulty in using the website.";
      $item_group_id = (isset($_GET["item_group"])) ? $_GET["item_group"]:'' ;
      $item_state = (isset($_GET["state"])) ? $_GET["state"]:'' ;
      $all_groups = Functions::getGroups();
        if(Functions::checkIfUserIsLoggedIn()){
          $user_requests = Notifications::getUserRequests();
          $number_of_requests = count($user_requests);
          $notification_messages = Notifications::getNotificationMessages();
          $number_of_notification_messages = count($notification_messages);
        }
      $message = Functions::getResponseMessages();
      $errors = Functions::getFormErrors();
      $this->page->stylesheets = "<link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/css/style.min.css'>";
      $this->page->body = include "src/Views/contactform.php";
      return $this->getResponse();
    }


    public function performContact(){
      if(isset($_POST['contact_submission'])){
        //if contact form has been submitted
        $contact_name = $_POST['contact_name'];
        $contact_email = $_POST['contact_email'];
        $contact_subject = $_POST['contact_title'];
        $contact_message = $_POST['contact_message'];
      
        $output = '<p>From Vensle.com - Contact Page</p><b/>-'.$contact_message;
        $body = $output; 
        $subject = $contact_subject." - Vensle.com";
        $email_to = "support@vensle.com";
        $fromserver = "noreply@Vensle.com"; 
        //this would definitel be refactored
        require("PHPMailer/PHPMailerAutoload.php");
        $mail = new \PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtpout.secureserver.net"; 
        $mail->SMTPAuth = true;
        $mail->Username = "augustine@vensle.com"; 
        $mail->Password = "sYet!9U4+E5b%UV";
        $mail->Port = 80;
        $mail->IsHTML(true);
        $mail->From = $contact_email;
        $mail->FromName = "Vensle.com - Contact Page.";
        $mail->Sender = $fromserver; 
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);
        $mail_sent = 1;
        if(!$mail->send()){
          $errors['not_sent'] = "Mailer Error: " . $mail->ErrorInfo;
          $errors['send_failed'] = "Message was not sent, please try again";
          $mail_sent = 1;
          }
        else{
          $_SESSION['message']='Your '.$contact_subject.' has been sent successully!.';
        }
      
        return Functions::redirectTo("/contact");
      }
      else{
        Functions::redirectTo("/contact");
      }
    }








    public function contactUs(){
      //  $from = new \Sendgrid\Mail\From($_POST['email'],$_POST['name']);
      //  var_dump($from);
      // var_dump($mail);
      try{
       $content = new \SendGrid\Mail\Content("text/html","Hello there EasySub, someone contacted you via the contact form on your website and this is what they had to say  
       ". $_POST['message']);
       $this->mail->setFrom($_POST['email'],$_POST['name']);
       $this->mail->setSubject($_POST['subject']);
       $this->mail->addContent($content);
       $this->mail->addTo("easysubnetworks@gmail.com", "Easysub Enterprises");
       $response = $this->sendgrid->send($this->mail);
       if($response->statusCode() == 202 || $response->statusCode() == 200 ){
         echo "OK";
       }
      }catch(\Exception $e){
         echo $e->getMessage();
      }
       
    }
}