<?php
namespace Controllers;
use Psr\Http\Message\ServerRequestInterface;
  use Models\Functions;
  use Models\Notifications;
use Models\PlaceRequest;
use Models\Products;
class DashboardController extends ZendResponse{
  public $page;

  public function __construct($page){
    $this->page = $page;
  }
    public function showDashboard(){
      Functions::redirectIfNotLoggedIn("login");
      $all_products = Functions::getAllProducts("no",false);
      if($all_products){
        $number_of_all_products = count($all_products);
      }else{
        $number_of_all_products = 0;
      }
      $this->page->title = "Vensle.com - My Dashboard";
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $country = Functions::getGeoInformation("country");
      $currency = Functions::getGeoInformation("currency");
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Dashboard";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      

      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
    }
      $this->page->body .= include "src/Views/dashboardsidebar.php";
      if($is_admin) {
        $this->page->body .= include "src/Views/dashboardadmin.php"; 
      }else {
        $this->page->body .= include "src/Views/dashboarduser.php"; 
      
      }
      $footer_custom_library = "
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/morris-chart/raphael-min.js'></script>
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/morris-chart/morris.js'></script>
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/morris-chart/dashboard1-init.js'></script>
  
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/calendar-2/moment.latest.min.js'></script>
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/calendar-2/semantic.ui.min.js'></script>
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/calendar-2/prism.min.js'></script>
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/calendar-2/pignose.calendar.min.js'></script>
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/calendar-2/pignose.init.js'></script>
  
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/owl-carousel/owl.carousel.min.js'></script>
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/owl-carousel/owl.carousel-init.js'></script>
  
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/datatables/datatables.min.js'></script>
      <script src='{$this->page->link}/vensle-assets/backend/js/lib/datatables/datatables-init.js'></script>";
      $this->page->body .= include "src/Views/dashboardfooter.php";
      return $this->getResponse();

    }

    public  function userUpload(){
      Functions::redirectIfNotLoggedIn("login");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $location = "";
      $description = "";
      $price = "";
      $sale_status = "";
      $item_contact_number = "";
      $userss = "";
      $location = "Federal Capital Territory";
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $country = Functions::getGeoInformation("country");
      $currency = Functions::getGeoInformation("currency");
      $bread = "Dashboard";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      

      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }

      $errors = Functions::getFormErrors();
      $this->page->title = "Vensle.com - Upload New Item";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Dashboard";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboarduploadform.php"; 
      $this->page->body .= include "src/Views/dashboardfooter.php"; 

      return $this->getResponse();
    }

    public function performUserUpload(){
      Functions::redirectIfNotLoggedIn("login");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $location = "";
      $description = "";
      $price = "";
      $sale_status = "";
      $item_contact_number = "";
      $userss = "";
      $location = "Federal Capital Territory";
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
  
      if(isset($_POST['submit'])) {
        if(!isset($_POST['item_condition'])) {
          $_POST['item_condition'] = "";
      }
      $required_fields = array("title", "item_condition", "category", "item_group", "item_address", "item_contact_number");
      Functions::checkIfParametersEmpty($required_fields);
      $title = $_POST['title'];
      $item_condition = (int) $_POST['item_condition'];
      $category = (int) $_POST['category'];
      $item_group = (int) $_POST['item_group'];
      $item_address = $_POST['item_address'];
      if(isset($_POST['location'])&& $_POST['location'] == ''){
        $location = "Federal Capital Territory";
      }
      else{
        $location = $_POST['location'];
      }
      
      $description = $_POST['description'];
      $price = (int) $_POST['price'];
      $sale_status = (int) $_POST['sale_status'];
      $item_contact_number = $_POST['item_contact_number'];

      
      $image_name = $_FILES['files']['name'];
      $image_temp = $_FILES['files']['tmp_name'];
      $allowed = array('jpg', 'jpeg', 'gif', 'png');

      if(empty($image_name[0])) {
          $errors['image'] = 'Please choose an image';
      }else {
        foreach ($image_name as $key => $name) {

                $name_arry = explode('.', $image_name[$key]);
                $name_ext = strtolower(end($name_arry));
            if(!in_array($name_ext, $allowed)) {
                $errors['image_ext'] = 'One or more images has an invalid extention, allowed extentions '. implode(', ', $allowed);
                break;
            }

        }
      }
      $userss = intval($_SESSION['user']['id']);
      if(empty($errors)) {
        $user_id = $userss;
        $upload_date = date('Y-m-d H:i:s');
        $product = new Products;
        $product->user_id = $user_id;
        $product->title = $title;
        $product->item_condition = $item_condition;
        $product->category = $category;
        $product->item_group = $item_group;
        $product->item_address = $item_address;
        $product->location = $location;
        $product->description = $description;
        $product->price = $price;
        $product->sale_status = $sale_status;
        $product->item_contact_number = $item_contact_number;
        $product->upload_date = $upload_date;
        $product->country = $country;
        $product->currency = $currency;
        $resultArray = $product->save();
        $result = $resultArray[0];
        $product_id = $resultArray[1];
        mkdir("{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/uploads/$product_id", 0775);
        $num_files = count($_FILES['files']['name']);
        $latest_img_id = 0;
            for ($i=0; $i < $num_files ; $i++) { 
                $img_arry = explode('.', $image_name[$i]);
                $image_ext = strtolower(end($img_arry));
                $latest_img_id = Functions::uploadImage($product_id, $image_temp[$i], $image_ext);
            }
            $errors['er'] = "image Extension = .".$image_ext;
            if($item_group == 1) {
            	$rfIntl = 'PA';
            }elseif ($item_group == 2) {
            	$rfIntl = 'FSN';
            }elseif ($item_group == 3) {
            	$rfIntl = 'ELC';
            }elseif ($item_group == 4) {
            	$rfIntl = 'CA';
            }elseif ($item_group == 5) {
            	$rfIntl = 'HG';
            }elseif ($item_group == 6) {
            	$rfIntl = 'SG';
            }elseif ($item_group == 7) {
            	$rfIntl = 'KB';
            }elseif ($item_group == 8) {
            	$rfIntl = 'GBI';
            }elseif ($item_group == 9) {
            	$rfIntl = 'MUS';
            }elseif ($item_group == 10) {
            	$rfIntl = 'FB';
            }elseif ($item_group == 11) {
            	$rfIntl = 'BK';
            }elseif ($item_group == 12) {
            	$rfIntl = 'RE';
            }else {
                $rfIntl = 'NG';
            }
            
            $ref_no = $rfIntl . $code . $product_id;
            $productUpdated = Functions::updateProductInformation($latest_img_id,$ref_no,$product_id);
            if($productUpdated[0]) {
              $_SESSION["message"] = "Product uploaded successfully pending approval";
              $new_req_id = $productUpdated[1];
              Functions::sendNotification($new_req_id, 'New Product', $_SESSION['user']['full_name'], "Uploaded an Item");
              Functions::sendNotification(25, ' New Product', $_SESSION['user']['full_name'], "Uploaded an Item");
              Functions::redirectTo("backend/my-products");;
          }else {
              $errors['failed'] = "Could not upload Item!. ";
          }
      }

      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $bread = "Dashboard";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }

      $errors = Functions::getFormErrors($errors);
      $this->page->title = "Vensle.com - Upload New Item";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Dashboard";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboarduploadform.php"; 
      $this->page->body .= include "src/Views/dashboardfooter.php"; 

      return $this->getResponse();


      }else{
        Functions::redirectTo("backend/");
      }
    }

    public function showUsersProducts(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $bread = "Dashboard";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }

      $errors = Functions::getFormErrors();
      $this->page->title = "Vensle.com - My Products";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "My Product";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboarduserproducts.php"; 
      $this->page->body .= include "src/Views/dashboardfooter.php"; 
      return $this->getResponse();
    }


    public function showSoldItems(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }

      $errors = Functions::getFormErrors();
      $this->page->title = "Vensle.com - Sold items";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Sold items";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardsolditems.php"; 
      $this->page->body .= include "src/Views/dashboardfooter.php"; 
      return $this->getResponse();
    }




    public function showPlaceRequest(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
      $this->page->title = "Vensle.com - Place a request";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Place a request";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardplacerequest.php"; 
      return $this->getResponse();
    }


    public function performPlaceRequest(){
      Functions::redirectIfNotLoggedIn("login");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $location = "";
      $description = "";
      $price = "";
      $sale_status = "";
      $item_contact_number = "";
      $userss = "";
      $location = "Federal Capital Territory";
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
  
      if(isset($_POST['submit'])) {
        if(!isset($_POST['item_condition'])) {
          $_POST['item_condition'] = "";
      }
      $required_fields = array("title", "item_address", "item_contact_number");
      Functions::checkIfParametersEmpty($required_fields);
      $title = $_POST['title'];
      $item_condition = (int) $_POST['item_condition'];
      $category = (int) $_POST['category'];
      $item_group = (int) $_POST['item_group'];
      $min_price = (int) $_POST['min_price'];
      $max_price = (int) $_POST['max_price'];
      $state = $_POST['state'];
      $description = $_POST['description'];
      $sale_status = (int) $_POST['sale_status'];
      $item_contact_number = $_POST['item_contact_number'];
      $item_address = $_POST['item_address'];
      if ($min_price >= $max_price) {
        $errors['price'] = "Maximum price cannot be lower or equal to minimum price.";
      }
      if($item_group == 1) {
        $rfIntl = 'PA';
      }elseif ($item_group == 2) {
        $rfIntl = 'FSN';
      }elseif ($item_group == 3) {
        $rfIntl = 'ELC';
      }elseif ($item_group == 4) {
        $rfIntl = 'CA';
      }elseif ($item_group == 5) {
        $rfIntl = 'HG';
      }elseif ($item_group == 6) {
        $rfIntl = 'SG';
      }elseif ($item_group == 7) {
        $rfIntl = 'KB';
      }elseif ($item_group == 8) {
        $rfIntl = 'GBI';
      }elseif ($item_group == 9) {
        $rfIntl = 'MUS';
      }elseif ($item_group == 10) {
        $rfIntl = 'FB';
      }elseif ($item_group == 11) {
        $rfIntl = 'BK';
      }elseif ($item_group == 12) {
        $rfIntl = 'RE';
      }else {
          $rfIntl = 'NG';
      }
      $image_name = $_FILES['files']['name'];
      $image_temp = $_FILES['files']['tmp_name'];
      $allowed = array('jpg', 'jpeg', 'gif', 'png');
      if(empty($image_name[0])) {
          $errors['image'] = 'Please choose an image';
      }else {
        foreach ($image_name as $key => $name) {
                $name_arry = explode('.', $image_name[$key]);
                $name_ext = strtolower(end($name_arry));
            if(!in_array($name_ext, $allowed)) {
                $errors['image_ext'] = 'One or more images has an invalid extention, allowed extentions '. implode(', ', $allowed);
                break;
            }

        }
      }
      $userss = intval($_SESSION['user']['id']);
      if(empty($errors)) {
        $requests_file = "{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/requests/";
        if(!file_exists($requests_file)){
          mkdir($requests_file, 0775);
        }
        $num_files = count($_FILES['files']['name']);
        $file_name = "";
            for ($i=0; $i < $num_files ; $i++) { 
                $img_arry = explode('.', $image_name[$i]);
                $image_ext = strtolower(end($img_arry));
                $file_name = substr(md5(time()), 0, 10) . '.' . $image_ext;
                $move = move_uploaded_file($image_temp[0], "{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/requests/{$file_name}");
                $last_request_id = Functions::getLastRequestId();
                $ref_no = "REQ".(int) $_SESSION['user']['id'].$rfIntl . $code . $last_request_id;
            }
            $placeRequest = new PlaceRequest;
            $placeRequest->user_id = $_SESSION['user']['id'];
            $placeRequest->title = $title;
            $placeRequest->item_condition = $item_condition;
            $placeRequest->category = $category;
            $placeRequest->item_group = $item_group;
            $placeRequest->item_address = $item_address;
            $placeRequest->display = $file_name;
            $placeRequest->description = $description;
            $placeRequest->state = $state;
            $placeRequest->min_price = $min_price;
            $placeRequest->max_price = $max_price;
            $placeRequest->ref_no = $ref_no;
            $placeRequest->country = $country;
            $placeRequest->item_contact_number = $item_contact_number;
            $placeRequest->resolved = 0;
	          $placeRequest->date_sent = date('Y-m-d H:i:s');
            $saved = $placeRequest->save();
            if($saved[0]){
              $last_request_id = $saved[1];
              Functions::sendNotification($last_request_id, 'Request Sent', $_SESSION['user']['full_name'], "sent an item request");
              $_SESSION["message"] = "Request sent successfully";
              Functions::redirectTo("backend/place-request");
            }else {
              $errors['no'] = "Could Not Upload Request, Contact Administrator.";
          }
      }

      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $bread = "Dashboard";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }

      $errors = Functions::getFormErrors($errors);
      $this->page->title = "Vensle.com - Upload New Item";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Dashboard";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboarduploadform.php"; 
      $this->page->body .= include "src/Views/dashboardfooter.php"; 

      return $this->getResponse();


      }else{
        Functions::redirectTo("backend/");
      }
    }



    public function showMyRequests(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      $this->page->title = "Vensle.com - My Requests";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "My Request";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardmyrequests.php"; 
      return $this->getResponse();
    }


    public function showBoughtItems(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      $this->page->title = "Vensle.com - Bought items";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Bought items";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardboughtitems.php"; 
      return $this->getResponse();
    }


    public function showUpdateProfile(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      $user = Functions::getUserById($_SESSION['user']['id']);
      $full_name = $user['full_name'];
      $email =  $user['email'];
      $phone =  $user['phone'];
      $address =  $user['address'];
      $profile_img = $user['profile_img'];
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      $this->page->title = "Vensle.com - My Profile";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "My Profile";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardupdateprofile.php"; 
      return $this->getResponse();
    }


    public function performUpdateProfile(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      $user = Functions::getUserById($_SESSION['user']['id']);
      $full_name = $user['full_name'];
      $email =  $user['email'];
      $phone =  $user['phone'];
      $address =  $user['address'];
      $profile_img = $user['profile_img'];
      if(isset($_POST['delete_user'])){
        if($is_admin == true){
            $delete = Functions::adminDeleteUser($_SESSION['user']['id']);
            if($delete){
              $_SESSION['message'] = "User has been deleted!";
              session_destroy();
              Functions::redirectTo();
            }
        }
        else{
          $delete = Functions::deleteUser();
          if($delete){
            $_SESSION['message'] = "User has been deleted!";
            session_destroy();
            Functions::redirectTo();
          }
          else{
            $errors['delete'] = "Could not delete user. Contact admin to delete your account";
          }
        }
            
      }

      if (isset($_POST['submit'])) {
        $required_fields = array("full_name", "email");
        Functions::checkIfParametersEmpty($required_fields);
        $fields_with_max_lengths = array("full_name" => 50, "email" => 50);
        Functions::validateMaxLengths($fields_with_max_lengths);
        $full_name      = $_POST["full_name"];
        $email          = $_POST["email"];
        $phone          = $_POST["phone"];
        $address        = $_POST["address"];
    
        if(!empty($_FILES['profile']['name'])) {
            $allowed = array('jpg', 'jpeg', 'gif', 'png');
            $file_name = $_FILES['profile']['name'];
            $file_extn = explode('.', $file_name);
            $file_extn = strtolower(end($file_extn));
            $file_temp = $_FILES['profile']['tmp_name'];
            if(in_array($file_extn, $allowed)) {
                Functions::changeProfileImage($file_temp, $file_extn);
                
            } else {
                $errors['file_type'] = "Incorrect file type. Allowed ". implode(', ', $allowed);
            }
    
        }
            
        if(empty($errors)) {
            if(Functions::updateUser($full_name, $email, $phone, $address)) {
                $_SESSION["message"] = "Profile updated successfully";
                Functions::redirectTo("backend/update-profile");
            } else {
                $errors['register'] = 'Something went wrong, please try again';        
            }
    
        }else {
    
        }
      }
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors($errors);
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      $this->page->title = "Vensle.com - My Profile";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "My Profile";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardupdateprofile.php"; 
      return $this->getResponse();
    }


    public function showChangePassword(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      $old_password = "";
      $new_password = "";
      $new_password_again = "";

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      $this->page->title = "Vensle.com - Change password";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Change password";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardchangepassword.php"; 
      return $this->getResponse();
    }


    public function performChangePassword(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      
     
      $old_password = "";
      $new_password = "";
      $new_password_again = "";
      if (isset($_POST['submit'])) {
        $required_fields = array("old_password", "new_password");
        Functions::checkIfParametersEmpty($required_fields);
        $fields_with_max_lengths = array("old_password" => 100, "new_password" => 100);
        Functions::validateMaxLengths($fields_with_max_lengths);
        $old_password           = $_POST["old_password"];
        $new_password           = $_POST["new_password"];
        $new_password_again     = $_POST["new_password_again"];
        if($new_password  !== $new_password_again) {
            $errors['update_password'] = "New password and New password again must be the same";
        }
        if(empty($errors)) {
            if (!Functions::confirmPassword($old_password)) {
                $errors['update_password'] = "Old password is incorrect";
            }
        }
        if(empty($errors)) {
            $hashed_password = Functions::encryptPassword($_POST["new_password"]);
            if(Functions::updatePassword($hashed_password)) {
                $_SESSION["message"] = "Password updated successfully";
                Functions::redirectTo("backend/change-password");
            } else {
                $errors['change_password'] = 'Something went wrong, please try again';        
            }
        }
    
      }
      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $this->page->title = "Vensle.com - Change password";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Change password";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardchangepassword.php"; 
      return $this->getResponse();
    }

    public function showMessageCompose(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      $subject = "";
      $message = "";
      $email = "";
      $recvd_id = (isset($_GET['weib_eing'])) ? $_GET['weib_eing'] : "";
      $recv_id = (isset($_GET['weib_ein'])) ? $_GET['weib_ein'] : "";
      $prod_id = (isset($_GET['prod_indent'])) ? $_GET['prod_indent'] : "";
      $req_id = (isset($_GET['req_ident'])) ? $_GET['req_ident'] : "";
      $num_inbox = 0;
      $num_draft = 0;

       //check if product belongs to user
      if(isset($_GET['prod_indent'], $_GET['weib_ein'])) {
        if(!Functions::checkIfProductBelongsToUser($prod_id,$recv_id)){
          Functions::redirectTo();
        }
      }
      //Check if request belongs to user
      if(isset($_GET['req_ident'], $_GET['weib_eing'])) {
        if(!Functions::checkIfRequestBelongsToUser($recvd_id, $req_id)){
          Functions::redirectTo();
        }
          if($_SESSION['user']['id'] == $recv_id or $_SESSION['user']['id'] == $recvd_id){
            $_SESSION['message'] = 'Not Allowed to Send Messages to Yourself';
            Functions::redirectTo($_SERVER['HTTP_REFERER']);
          }
      }


      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      $this->page->title = "Vensle.com - Message Compose";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Message Compose";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardmessagecompose.php"; 
      return $this->getResponse();
    }


    public function performMessageCompose(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      $subject = "";
      $message = "";
      $email = "";
      $recvd_id = (isset($_GET['weib_eing'])) ? $_GET['weib_eing'] : "";
      $recv_id = (isset($_GET['weib_ein'])) ? $_GET['weib_ein'] : "";
      $prod_id = (isset($_GET['prod_indent'])) ? $_GET['prod_indent'] : "";
      $req_id = (isset($_GET['req_ident'])) ? $_GET['req_ident'] : "";
      $num_inbox = 0;
      $num_draft = 0;

       //check if product belongs to user
      if(isset($_GET['prod_indent'], $_GET['weib_ein'])) {
        if(!Functions::checkIfProductBelongsToUser($prod_id,$recv_id)){
          Functions::redirectTo();
        }
      }
      //Check if request belongs to user
      if(isset($_GET['req_ident'], $_GET['weib_eing'])) {
        if(!Functions::checkIfRequestBelongsToUser($recvd_id, $req_id)){
          Functions::redirectTo();
        }
          if($_SESSION['user']['id'] == $recv_id or $_SESSION['user']['id'] == $recvd_id){
            $_SESSION['message'] = 'Not Allowed to Send Messages to Yourself';
            Functions::redirectTo($_SERVER['HTTP_REFERER']);
          }
      }

      if (isset($_POST['subject'], $_POST['message'], $_POST['msg_send'])) {
        $required_fields = array("subject", "message");
        Functions::checkIfParametersEmpty($required_fields);
        $subject = $_POST["subject"];
        $message = $_POST["message"];
        if(empty($errors)) {
              if(Functions::sendMessage($email, $recv_id, $subject, $message, $prod_id)) {
                  $_SESSION["message"] = "Message successfully sent";
                  Functions::redirectTo("/backend/message-sent");
              } else {
                  $errors['message'] = 'Message could not be sent, please try again';
              }
        }
      }


      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors($errors);
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      $this->page->title = "Vensle.com - Message Compose";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Message Compose";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardmessagecompose.php"; 
      return $this->getResponse();
    }

    public function showMessageInbox(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      
      $this->page->title = "Vensle.com - Message Inbox";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Message Inbox";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardmessageinbox.php"; 
      return $this->getResponse();
    }


    public function showMessageDraft(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      
      $this->page->title = "Vensle.com - Message Draft";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Message Inbox";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardmessagedraft.php"; 
      return $this->getResponse();
    }


    public function showMessageSent(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      
      $this->page->title = "Vensle.com - Message Inbox";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Message Inbox";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardmessagesent.php"; 
      return $this->getResponse();
    }


    public function showReadMessage(){
      Functions::redirectIfNotLoggedIn("login");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
     
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }

      if(!isset($_GET['verste'])) {
        Functions::redirectTo('/backend/');
      }
      $msg_id = $_GET['verste'];

      if(!Functions::getRelatedMessages($msg_id)) {
        Functions::redirectTo('/backend/');
      }
      //if messages are either from the logged in user.
      $read_msg =  Functions::getMessagesById($msg_id);
      Functions::setMessagesRead($msg_id);
      Functions::deleteNotification($msg_id);

      $subject = "";
      $message = "";
      if (isset($_POST['subject'], $_POST['message']) ) { // if reply subjecy and reply message are set
        $required_fields = array("subject", "message");
        Functions::checkIfParametersEmpty($required_fields);
        $subject = $_POST["subject"];
        $message = $_POST["message"];
        if($read_msg['reply_id'] != 0) {
          $msg_id = $read_msg['reply_id'];
        }
        $errors = Functions::getFormErrors();
        if(empty($errors)) {
              if(Functions::sendMessage($email = "", $read_msg['other'], $subject, $message, $read_msg['product_id'], $msg_id)) {
                  $_SESSION["message"] = "Message successfully sent";
                  Functions::redirectTo("/backend/message-sent");
              } else {
                  $errors['message'] = 'Message could not be sent, please try again';
              }
        }
      }   

      $this->page->title = "Vensle.com - Read Messages";
      $this->page->stylesheet = "
        <style type='text/css'>
        #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
        .img-placeholder {
          width: 60%;
          color: white;
          height: 100%;
          background: black;
          opacity: .7;
          height: 210px;
          border-radius: 50%;
          z-index: 2;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          display: none;
        }
        .img-placeholder h4 {
          margin-top: 40%;
          color: white;
        }
        .img-div:hover .img-placeholder {
          display: block;
          cursor: pointer;
        }
        </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Message Inbox";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/dashboardreadmessages.php"; 
      return $this->getResponse();
    }


    public function showAllRequests(){
      Functions::redirectIfNotLoggedIn("login");
      Functions::redirectIfNotAdmin("backend/my-requests");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      
      $this->page->title = "Vensle.com -All requests";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "All request";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/adminallrequests.php"; 
      return $this->getResponse();
    }


    public function showAllProducts(){
      Functions::redirectIfNotLoggedIn("login");
      Functions::redirectIfNotAdmin("backend/my-products");
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $number_of_unread_messages = Functions::getNumberOfUnreadMessages($_SESSION['user']['id']);
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $title = "";
      $item_condition = "";
      $category = "";
      $item_group = "";
      $item_address = "";
      $state = "Abuja Federal Capital Territory";
      $description = "";
      $min_price = "";
      $max_price = "";
      $item_contact_number = "";
      $sale_status = "";
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        // $request_count1 = mysqli_num_rows($res); 
        // replace $res with $unapproved_requests
    
        // get number of unapproved products for each user , replace res1 with unapproved_products
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
        if (isset($_GET['noti'])) {
          $notification_id = $_GET['noti'];
          Functions::deleteNotification($notification_id);
      }
      
      $this->page->title = "Vensle.com -All products";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "All products";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/adminallproducts.php"; 
      return $this->getResponse();
    }


    public function deleteRequest(){
      Functions::redirectIfNotLoggedIn("/login");
      if(!isset($_SERVER['HTTP_REFERER'])) {
        Functions::redirectTo('/backend');
      }
      if(!isset($_GET['hilfe'])) {
        Functions::redirectTo('/backend');
      }
      $is_admin = Functions::checkIfUserIsAdmin();
      $req_id = $_GET['hilfe'];
      if(Functions::getRequestById($req_id, $is_admin)) {
        $deleted = Functions::deleteRequest($req_id);
        if($deleted){
          Functions::deleteNotification($req_id);
        }
        
      }else {
        Functions::redirectTo();
      }
        $_SESSION["message"] = "Request deleted";
        Functions::redirect($_SERVER['HTTP_REFERER']);
    }

    public function deleteProduct(){
      Functions::redirectIfNotLoggedIn("/login");
      $is_admin = Functions::checkIfUserIsAdmin();
      if(isset($_GET['verste'])) {
        $id = $_GET['verste'];
      } else {
      }
      if($is_admin) {
        Functions::deleteProperty($id);
        }else {
          if(Functions::checkIfProductBelongsToUser($id)){
            Functions::deleteProperty($id);
          }else{
            Functions::redirectTo("/backend");
          }
        }
      $_SESSION["message"] = "Product deleted";
      Functions::redirect($_SERVER['HTTP_REFERER']);
    }
    public function featureProduct(){
      Functions::redirectIfNotLoggedIn("/login");
      $is_admin = Functions::checkIfUserIsAdmin();
      if(isset($_GET['verste'])) {
        $id = $_GET['verste'];
      } else {
      }
      Functions::featureProduct($id);
      echo "1";
      //$_SESSION["message"] = "Product Featured";
      //Functions::redirect($_SERVER['HTTP_REFERER']);
    }
    public function setProductPosition(){
      Functions::redirectIfNotLoggedIn("/login");
      $is_admin = Functions::checkIfUserIsAdmin();
      if(isset($_POST['product_id'],$_POST['position'])) {
        $id = $_POST['product_id'];
        $post = $_POST['position'];
      } else {

      }
      Functions::setFeaturedProductPosition($id,$post);
      $_SESSION["message"] = "Product Position is set";
      Functions::redirect($_SERVER['HTTP_REFERER']);
    }
    public function unfeatureProduct(){
      Functions::redirectIfNotLoggedIn("/login");
      $is_admin = Functions::checkIfUserIsAdmin();
      if(isset($_GET['verste'])) {
        $id = $_GET['verste'];
      } else {
      }
      Products::unfeatureProduct($id);
      echo "1";  
      //$_SESSION["message"] = "Removed Product Feature ";
      //Functions::redirect($_SERVER['HTTP_REFERER']);
    }

    public function showApproveProduct(){
      Functions::redirectIfNotLoggedIn("/login");
      Functions::redirectIfNotAdmin("/backend");
      $is_admin = Functions::checkIfUserIsAdmin();
      if (isset($_GET['approve'])) {
        $id = (int)$_GET['approve'];
        $approved = Functions::approveProduct($id);
        if ($approved) {
            $_SESSION["message"] = "Product approved successfully";
            Functions::redirectTo('/backend/approve-product');
        }
      }
      $find_my_products = Functions::getPendingProducts($is_admin);
      $no_apprv = count($find_my_products);
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();

      $this->page->title = "Vensle.com - Pending products";
      $this->page->stylesheet = "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
      <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' />
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Approve Product";
      $menu_btns = true;
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/adminapprovedproducts.php"; 
      return $this->getResponse();

    }


    public function performApproveProduct(){
      Functions::redirectIfNotLoggedIn("/login");
      Functions::redirectIfNotAdmin("/backend");
      $is_admin = Functions::checkIfUserIsAdmin();
      if(isset($_POST['decline'])) {
        $prod_set = Products::getProductById($_POST['dcln_id'],false,false);
        $deleted = Products::deleteProduct($_POST['dcln_id']);
        $title = 'Product declined';
        $sender_name = $prod_set['title'].' was declined ';
        $body = $_POST['decline_msg'];
        $receiver_id = $prod_set['user_id'];
        Functions::sendNotification($_POST['dcln_id'], $title, $sender_name, $body, $receiver_id);
        Functions::sendMessage("",$receiver_id,$title,$sender_name." because ".$body,$_POST['dcln_id']);
        $_SESSION["message"] = "Product declined";
        return Functions::redirectTo("/backend/approve-product");
      } else {
        $errors['register'] = 'An error occured please try again';        
      }
    }

    public function showApproveRequest(){
      Functions::redirectIfNotLoggedIn("/login");
      Functions::redirectIfNotAdmin("/backend");
      $is_admin = Functions::checkIfUserIsAdmin();
      if (isset($_GET['approve'])) {
        $id = (int)$_GET['approve'];
        $approved = Functions::approveRequest($id);
        if ($approved) {
            $_SESSION["message"] = "Request approved successfully";
            Functions::redirectTo('/backend/approve-request');
        }
      }
      $find_my_products = Functions::getPendingProducts($is_admin);
      $no_apprv = count($find_my_products);
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $no_user_products = 1;
      $no_user_requests = 2;
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
      $find_pending_requests = Functions::getPendingRequests($is_admin);
      $no_apprv1 = count($find_pending_requests);
      $this->page->title = "Vensle.com - Pending requests";
      $this->page->stylesheet = "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
      <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' />
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Approve Requests";
      // $menu_btns = true;
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/adminapprovedrequests.php"; 
      return $this->getResponse();

    }


    public function showCategoryDisplay(){
      Functions::redirectIfNotLoggedIn("/login");
      Functions::redirectIfNotAdmin("/backend");
      $is_admin = Functions::checkIfUserIsAdmin();
      $cat_exist = false;
      $old_first_img = "";
      $old_second_img = "";
      $old_third_img = "";
      $old_forth_img = "";

      if(isset($_GET['cat'])) {
        $cat_id = $_GET['cat'];
        $cat_set = Functions::getCategory($cat_id);
        if (count($cat_set) > 0) {
            $each_cat = $cat_set;
        }
        if(isset($_GET['del_cat'])) {
            $del_cat = $_GET['del_cat'];
            $img_links = [$each_cat['image_1'], $each_cat['image_2'], $each_cat['image_3'], $each_cat['image_4']];
            $find_link = array_search($each_cat[$del_cat], $img_links);
            unset($img_links[$find_link]);
            $new_links = array_values($img_links);
            unlink("{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/display_category/" . $each_cat[$del_cat]);
            Functions::updateCategoryImage($new_links[0], $new_links[1], $new_links[2], "", $cat_id);
            Functions::redirectTo('/backend/category-display?cat='.$cat_id);
            
        }

        if(isset($_POST['add_cat_img'], $_FILES['files'])) {
            $image_name = $_FILES['files']['name'];
            $image_temp = $_FILES['files']['tmp_name'];
            $allowed = array('jpg', 'jpeg', 'gif', 'png');
            if(empty($image_name[0])) {
                $errors['image'] = 'Please choose an image';
            }else {
                foreach ($image_name as $key => $name) {
                    $name_arry = explode('.', $image_name[$key]);
                    $name_ext = strtolower(end($name_arry));
                    if(!in_array($name_ext, $allowed)) {
                        $errors['image_ext'] = 'One or more images has an invalid extention, allowed extentions '. implode(', ', $allowed);
                        break;
                    }
                }
                if(empty($errors)) {
                    if(isset($image_name[0])) {
                        $old_first_img = $image_name[0];
                        $file_extn1 = explode('.', $old_first_img);
                        $file_extn1 = strtolower(end($file_extn1));
                        $str1 = time().$old_first_img;
                        $old_first_img = substr(md5($str1), 0, 10) . '.' . $file_extn1;
                        move_uploaded_file($image_temp[0], "{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/display_category/" . $old_first_img);
                    }
                    if(isset($image_name[1])) {
                        $old_second_img = $image_name[1];
                        $file_extn2 = explode('.', $old_second_img);
                        $file_extn2 = strtolower(end($file_extn2));
                        $str2 = time().$old_second_img;
                        $old_second_img = substr(md5($str2), 0, 10) . '.' . $file_extn2;
                        move_uploaded_file($image_temp[1], "{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/display_category/" . $old_second_img);
                    }
                    if(isset($image_name[2])) {
                        $old_third_img = $image_name[2];
                        $file_extn3 = explode('.', $old_third_img);
                        $file_extn3 = strtolower(end($file_extn3));
                        $str3 = time().$old_third_img;
                        $old_third_img = substr(md5($str3), 0, 10) . '.' . $file_extn3;

                        move_uploaded_file($image_temp[2], "{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/display_category/" . $old_third_img);
                    }
                    if(isset($image_name[3])) {
                        $old_forth_img = $image_name[3];

                        $file_extn4 = explode('.', $old_forth_img);
                        $file_extn4 = strtolower(end($file_extn4));
                        $str4 = time().$old_forth_img;
                        $old_forth_img = substr(md5($str4), 0, 10) . '.' . $file_extn4;

                        move_uploaded_file($image_temp[3], "{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/display_category/" . $old_forth_img);
                    }
                    

                    if($each_cat['image_1'] == "") {
                        $first_img = $old_first_img;
                        $second_img = $old_second_img;
                        $third_img = $old_third_img;
                        $forth_img = $old_forth_img;
                    }
                    if($each_cat['image_1'] != "") {
                        $first_img = $each_cat['image_1'];
                        $second_img = $old_first_img;
                        $third_img = $old_second_img;
                        $forth_img = $old_third_img;
                    }if($each_cat['image_2'] != "") {
                        $first_img = $each_cat['image_1'];
                        $second_img = $each_cat['image_2'];
                        $third_img = $old_first_img;
                        $forth_img = $old_second_img;
                    }if($each_cat['image_3'] != "") {
                        $first_img = $each_cat['image_1'];
                        $second_img = $each_cat['image_2'];
                        $third_img = $each_cat['image_3'];
                        $forth_img = $old_first_img;
                    }if($each_cat['image_4'] != "") {
                        $first_img = $each_cat['image_1'];
                        $second_img = $each_cat['image_2'];
                        $third_img = $each_cat['image_3'];
                        $forth_img = $each_cat['image_4'];
                    }
                    Functions::updateCategoryImage($first_img, $second_img, $third_img, $forth_img, $cat_id);
                    $_SESSION["message"] = "Image(s) uploaded successfully";
                    Functions::redirectTo(Functions::getBackendAssetsLink().'category_display?cat=' . $cat_id);
                }
            }
        }
      }else{
        $cat_id = null;
      }

      $find_my_products = Functions::getPendingProducts($is_admin);
      $no_apprv = count($find_my_products);
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();

      $this->page->title = "Vensle.com - Category Display";
      $this->page->stylesheet = "<link rel='stylesheet' href='{$this->page->link}/vensle-assets/css/vensle_custom.css'>
      <style>
          .list-group-item {
              border-color: #e0e0e0;
              // cursor: pointer;
          }
          .list-group-item:hover {
              background-color: #eee;
          }

          .activated {
              background-color: #eee;
          }
          .list-group-item a.minus {
              float: right;
              padding: 0 7px;
          }
          .list-group-item a.minus:hover {
             background: #c53e3e;
          }
          .list-group-item a.minus:hover .fa-minus {
              color: #fff;
          }
          .no_img {
              width: 200px;
              height: 200px;
          }
      </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Category Display";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/admincategorydisplay.php"; 
      return $this->getResponse();

    }


    public function showFeaturedProduct(){
      Functions::redirectIfNotLoggedIn("/login");
      Functions::redirectIfNotAdmin("/backend");
      $is_admin = Functions::checkIfUserIsAdmin();
      $find_my_products = Functions::getPendingProducts($is_admin);
      $no_apprv = count($find_my_products);
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();

      $this->page->title = "Vensle.com - Featured Products";
      $this->page->stylesheet = "<link href='{$this->page->link}/vensle-assets/backend/css/lib/calendar2/semantic.ui.min.css' rel='stylesheet'>
      <link href='{$this->page->link}/vensle-assets/backend/css/lib/calendar2/pignose.calendar.min.css' rel='stylesheet'>
      <link href='{$this->page->link}/vensle-assets/backend/css/lib/owl.carousel.min.css' rel='stylesheet' />
      <link href='{$this->page->link}/vensle-assets/backend/css/lib/owl.theme.default.min.css' rel='stylesheet' />
      <style>
          .bg-dark {
              background: #444c67 !important;
              color: #ffffff;
          }
      </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Dashboard";
      $menu_btns = true;
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/adminfeaturedproducts.php"; 
      return $this->getResponse();

    }public function showFeaturedProducts(){
      Functions::redirectIfNotLoggedIn("/login");
      Functions::redirectIfNotAdmin("/backend");
      $is_admin = Functions::checkIfUserIsAdmin();
      $find_my_products = Functions::getPendingProducts($is_admin);
      $no_apprv = count($find_my_products);
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $no_user_products = 1;
      $no_user_requests = 2;
      $is_admin = Functions::checkIfUserIsAdmin();
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();

      if(isset($_GET['cat'])) {
        $cat_id = $_GET['cat'];
        $cat_set = Functions::getCategory($cat_id);
        if (count($cat_set) > 0) {
            $each_cat = $cat_set;
        }
        if(isset($_GET['del_cat'])) {
            $del_cat = $_GET['del_cat'];

            Functions::redirectTo('/backend/adminfeaturedproducts?cat='.$cat_id.'&action=del_cat');
            
        }
      }
      else{
        $cat_id = null;
      }

      $this->page->title = "Vensle.com - Featured Products";
      $this->page->stylesheet = "<link href='{$this->page->link}/vensle-assets/backend/css/lib/calendar2/semantic.ui.min.css' rel='stylesheet'>
      <link href='{$this->page->link}/vensle-assets/backend/css/lib/calendar2/pignose.calendar.min.css' rel='stylesheet'>
      <link href='{$this->page->link}/vensle-assets/backend/css/lib/owl.carousel.min.css' rel='stylesheet' />
      <link href='{$this->page->link}/vensle-assets/backend/css/lib/owl.theme.default.min.css' rel='stylesheet' />
      <style>
          .bg-dark {
              background: #444c67 !important;
              color: #ffffff;
          }
      </style>";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "Dashboard";
      $menu_btns = true;
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/adminfeaturedproducts.php"; 
      return $this->getResponse();

    }


    public function showUsers(){
      Functions::redirectIfNotLoggedIn("/login");
      Functions::redirectIfNotAdmin("/backend");
      $is_admin = Functions::checkIfUserIsAdmin();
      $find_my_products = Functions::getPendingProducts($is_admin);
      $no_apprv = count($find_my_products);
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      $no_user_products = 1;
      $no_user_requests = 2;
      $no_user_pending_products = Functions::getPendingProducts($is_admin);
      $no_user_pending_requests = Functions::getPendingRequests($is_admin);
      $numm = 0;
      $sold_sum = Functions::getNumberOfSoldItems();
      $users_products = Functions::getUsersProducts();
      $my_products = Functions::getAllProducts('no',true,'2');
      

      if($users_products){
        $number_of_users_products = count($users_products);
      }else{
        $number_of_users_products = 0;
      }
      if($my_products){
        $number_of_my_products = count($my_products);
      }else{
        $number_of_my_products = 0;
      }
      if($no_user_pending_requests){
        $n1 = count($no_user_pending_requests);
      }else{
        $n1 = 0;
      }
      if($no_user_pending_products){
        $n2 = count($no_user_pending_products);
      }else{
        $n2 = 0;
      }
      if ($is_admin) {
          $find_unsold_products = Functions::getPendingProducts($is_admin);
          if($find_unsold_products){
            $no_apprv = count($find_unsold_products);
          }else{
            $no_apprv = 0;
          }
          
          $find_pending_requests = Functions::getPendingRequests($is_admin);
          if($find_pending_requests){
            $request_count1 = count($find_pending_requests);
          }else{
            $request_count1 = 0;
          }
      }else{
        $find_unsold_products =  Functions::getPendingProducts($is_admin);
        $find_pending_products = Functions::getPendingRequests($is_admin);
        $unapproved_requests = Functions::getUnapprovedRequests();
        if($unapproved_requests){
          $request_count1 = count($unapproved_requests);
        }else{
          $request_count1 = 0;
        } 
        $unapproved_prodcuts = Functions::getUnapprovedProducts();
        if($unapproved_prodcuts){
          $no_apprv = count($unapproved_prodcuts);
        }else{
          $no_apprv = 0;
        }
       
      }
      $errors = Functions::getFormErrors();
      $this->page->title = "Vensle.com - All Users";
      $this->page->body = include "src/Views/dashboardnav.php";
      $bread = "All Users";
      $this->page->body .= include "src/Views/dashboardsidebar.php"; 
      $this->page->body .= include "src/Views/adminallusers.php"; 
      return $this->getResponse();

    }






























    public function logUserout(){
      $_SESSION["user"] = null;
      if(isset($_SERVER['HTTP_REFERER'])) {
        header("Location: ".$_SERVER['HTTP_REFERER']);
      }else {
        Functions::redirectTo("/login");
      }
    }

}
                