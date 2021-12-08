<?php
namespace Controllers;
use Psr\Http\Message\ServerRequestInterface;
  use Models\Functions;
  use Models\Notifications;
class SearchController extends ZendResponse{
  public $page;

  public function __construct($page){
    $this->page= $page;
  }


  public function showSearch(){
      $this->page->title = "Vensle | Your Favourite Online shopping website";
      $this->page->metaDescription = "Login if you are already registered to upload an item, place a request chat a user and have the best experience on vensle.com";
      $this->page->stylesheets = "
      <link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/css/style.min.css'>
        <link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/vendor/photoswipe/photoswipe.min.css'>
        <link rel='stylesheet' type='text/css' href='{$this->page->link}/vensle-assets/V11/vendor/photoswipe/default-skin/default-skin.min.css'>
      ";
     
      $keywords = "";
      $feedback = "";
      $item_group_id = "";
      $is_admin = Functions::checkIfUserIsAdmin();
      $country = Functions::getGeoInformation("country");
      $code = Functions::getGeoInformation("code");
      $currency = Functions::getGeoInformation("currency");
      if(isset($_GET['keywords']) && isset($_GET['category']) && $_GET['category'] != '') {
          $home_cat = (int)$_GET['category'];
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
            $keywords = htmlentities(trim($_GET['keywords']));
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
      if(!isset($_GET['keywords'])) {
        Functions::redirectTo("/");
        exit;
      }
      $suffix = "";
      if(strlen($keywords) < 3) {
        $errors['length'] = 'Your search must be more than 3 characters';
      } else if(Functions::getSearchResults($keywords, $item_group_id, $home_cat) === false) {
        $feedback = '<p>Your search for <strong>'. $keywords . '</strong> returned no results</p>';
      }
      $sort = '';
      $min_price = null;
      $max_price = null;
      if(isset($_GET['search_filter'])) {
        if(isset($_GET['min_price'])) {
          $min_price = ($_GET['min_price'] > 0) ? $_GET['min_price'] : null ;
        }
        if(isset($_GET['max_price'])) {
          $max_price = ($_GET['max_price'] > 0) ? $_GET['max_price'] : null ;
        }
        if($_GET['sort'] == 'asc') {
          $sort = 'asc';
        }elseif ($_GET['sort'] == 'desc') {
          $sort = 'desc';
        }
        if($min_price > 0) {
          if($max_price <= 0){
            $max_price = false;			
          }
        }	
        if($max_price > 0) {
          if($max_price < $min_price) {
            $max_price = 0;
          }

          if($min_price <= 0) {
            $min_price = false;
          }

        }

        if (empty($errors) && $feedback == "" ) {
          $results = Functions::getSearchResults($keywords, $item_group_id, $home_cat, $item_state, $min_price, $max_price, $sort);
          if($results === false) {
            $feedback = '<p>No Result Found!</p>';
          }else {
            $results_num = count($results);
          }
        }
      }
      $message = Functions::getResponseMessages();
      $errors = Functions::getFormErrors();
      $this->page->stylesheetsBefore = "<link rel='stylesheet' href='{$this->page->link}/vensle-assets/css/bootstrap.min.css'>";
      $this->page->scripts =  "<script src='{$this->page->link}/vensle-assets/V11/js/home.js'></script>";
      $this->page->body = include "src/Views/searchpage.php";
      return $this->getResponse();

  }


}
                