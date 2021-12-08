<?php
namespace Controllers;
use Psr\Http\Message\ServerRequestInterface;
  use Models\Functions;
  use Models\Notifications;
  use Models\Users;
class AjaxController extends ZendResponse{
    public function registerUser(){
      //checks if the submit parameter is present
      if(isset($_POST['submit'])){
        $full_name      = $_POST["fullName"];
        $business_name  = $_POST["busName"];
        $email          = $_POST["regEmail"];
        $phone          = $_POST["phone"];
        $address        = $_POST["address"];
        $password       = $_POST["regPass"];
        $confirm_password = $_POST["regPassAgn"];
        $required_fields = array("fullName", "regPass", "regEmail", "phone", "address");
        Functions::checkIfParametersEmpty($required_fields);
        $fields_with_max_lengths = array("fullName" => 50, "regPass" => 50);
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
            echo 1;
          } else {
            echo 2;
          }
        }


      }
    }
    public function signUserIn(){
        if(isset($_POST['email']) && isset($_POST['email'])){
          $required_fields = array("email", "password");
          Functions::checkIfParametersEmpty($required_fields);
          $password = $_POST["password"];
          $email = $_POST["email"];
          if(empty($errors)) {
            $loggedIn = Functions::logUserIn($email, $password);
            if($loggedIn) {
              echo 1;
            } 
            else {
              echo 0;
            }
          }
        }
    }

    public function getCategoriesByGroup(){
      if(isset($_POST['group_id'])) {
        $id = $_POST['group_id'];
        $cat_groups = Functions::getCategoriesByGroup($id);
        $out = '<option value="">Select Category</option>';

        foreach($cat_groups as $cat_group) {
            $out .= "<option value='{$cat_group['id']}'> {$cat_group['name']} </option>";
        }
        echo $out;
	    }
    }

    public function getApprovedProductsPage(){
      Functions::redirectIfNotAdmin("/backend");
      if(isset($_POST['limit'], $_POST['start'])) {
        $start= $_POST['start'];
        $limit= $_POST['limit'];
        $is_admin = Functions::checkIfUserIsAdmin();
        $find_my_products = Functions::getPendingProducts($is_admin);
        $no_apprv = count($find_my_products);
        $currency = Functions::getGeoInformation("currency");
        $response = include "src/Views/ajaxapprovedproducts.php";
        echo ($response);
        // echo $response;



      
      
      
      }
    }
    public function getProducts(){
      if(isset($_POST['country'], $_POST['group_id'])) {
        $country= $_POST['country'];
        $group_id= $_POST['group_id'];
        @$cat_id= $_POST['cat_id'];
        $is_admin = Functions::checkIfUserIsAdmin();
        //$find_my_products = Functions::getSectionedProducts('no',$is_admin,$country,$group_id,$cat_id);
        //$no_apprv = count($find_my_products);
        $currency = Functions::getGeoInformation("currency");
        $response = include "src/Views/sectionProducts.php";
        echo ($response);

    }
  }

  

}
                