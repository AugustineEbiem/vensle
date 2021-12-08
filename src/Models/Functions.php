<?php 
namespace Models;
use Controllers\PageBuilder;
class Functions extends Model{

    public static function is_countable($value) { return is_array($value) || $value instanceof Countable || $value instanceof ResourceBundle || $value instanceof SimpleXmlElement; }

    public static function getGroups($active=true) {
        $result_set = ItemGroup::getGroups($active);
        return ($result_set) ? $result_set : false ;
    }

    public static function getCategory($cat_id){
        $result_set = FrontDisplay::getCategory($cat_id);
        return ($result_set) ? $result_set : false ;
    }

    public static function updateCategoryImage($image1,$image2,$image3,$image4,$cat_id){
        $result_set = FrontDisplay::updateCategoryImage($image1,$image2,$image3,$image4,$cat_id);
        return ($result_set) ? $result_set : false ;
    }

    public static function getAllCategories(){
        $result_set = FrontDisplay::getAllCategories();
        return ($result_set) ? $result_set : false ;
    }

    public static function getCategoriesByGroup($id,$active=true){
        $result_set = ItemCategory::getCategoriesByGroup($id);
        return ($result_set) ? $result_set : false ;
    } 

    public static function getGroupsCategories($name,$value,$country=false,$limit="yes"){
        $result_set = Products::getGroupsCategories($name,$value,$country,$limit);
        return ($result_set) ? $result_set : false ;
    }
    public static function frontCategories(){
        $result_set = Products::frontCategories();
        return ($result_set) ? $result_set : false ;
    } 

    public static function getProductDetailsById($id,$check_approved = false){
        $result_set = Products::getProductDetailsById($id,$check_approved);
        return ($result_set) ? $result_set : false ;
    }

    public static function getProductById($id, $sold = false, $mine=false){
        $result_set = Products::getProductById($id, $sold, $mine);
        return ($result_set) ? $result_set : false ;
    }

    public static function getAllProducts($sold = 'no', $not_admin = true, $limit = false, $profile_id = false) {
        $result_set = Products::getAllProducts($sold,$not_admin,$limit,$profile_id);
        return ($result_set) ? $result_set : false ;
    }
    public static function getSectionedProducts($sold = 'no', $not_admin = true, $country = false, $group_id = false,$cat_id) {
        $result_set = Products::getSectionedProducts($sold,$not_admin,$country,$group_id,$cat_id);
        return ($result_set) ? $result_set : false ;
    }

    public static function getAllProductsByUserId($id) {
        $result_set = Products::getAllProductsByUserId($id);
        return ($result_set) ? $result_set : false ;
    }

    public static function makeFeaturedProduct($cat_id,$prod_id,$position){
        $result_set = Products::makeCategoryFeaturedProduct($cat_id,$prod_id,$position);
        return ($result_set) ? $result_set : false ;
    }
    public static function getFeaturedProducts(){
        $result_set = Products::getFeaturedProducts();
        return ($result_set) ? $result_set : false ;
    }
    public static function getCategoryFeaturedProduct($cat_id){
        $result_set = Products::getCategoryFeaturedProduct($cat_id);
        return ($result_set) ? $result_set : false ;
    }

    public static function getPendingProducts($is_admin = true,$start=false,$limit = false){
        $result_set = Products::getPendingProducts($is_admin,$start,$limit);
        return ($result_set) ? $result_set : false ;
    }

    public static function getUnapprovedProducts(){
        $result_set = Products::getUnapprovedProducts();
        return ($result_set) ? $result_set : false ;
    }
    public static function getUsersProducts(){
        $result_set = Products::getUsersProducts();
        return ($result_set) ? $result_set : false ;
    }

    public static function getNumberOfSoldItems($admin=true){
        $result_set = Products::getNumberOfSoldItems();
        return ($result_set) ? $result_set : false ;
    }
    public static function getUserSoldItems($id){
        $result_set = Products::getUserSoldItems($id);
        return ($result_set) ? $result_set : false ;
    }

    public static function approveProduct($id){
        $id = (int) $id;
        $result_set = Products::approveProduct($id);
        return ($result_set) ? $result_set : false ;
    }
    public static function featureProduct($id){
        $id = (int) $id;
        $result_set = Products::featureProduct($id);
        return ($result_set) ? $result_set : false ;
    }
    public static function setFeaturedProductPosition($product_id,$position){
        $product_id = (int) $product_id;
        $result_set = Products::setFeaturedProductPosition($product_id,$position);
        return ($result_set) ? $result_set : false ;
    }
    public static function unfeatureProduct($id){
        $id = (int) $id;
        $result_set = Products::featureProduct($id);
        return ($result_set) ? $result_set : false ;
    }

    public static function checkIfProductBelongsToUser($id,$user_id = NULL){
        $result_set = Products::checkIfProductBelongsToUser($id,$user_id);
        return ($result_set) ? $result_set : false ;
    }


    public static function updateProductInformation($latest_img_id,$ref_no,$product_id){
        $result_set = Products::updateProductInformation($latest_img_id,$ref_no,$product_id);
        return ($result_set) ? $result_set : false ;
    }

    public static function getSearchResults($keywords, $item_group_id, $home_cat=false, $item_state = '', $min_price = 0, $max_price = 0, $sort = ''){
        $results = Products::search($keywords, $item_group_id, $home_cat, $item_state, $min_price, $max_price, $sort);
        $results_num = isset($results) ? count($results) : 0;
        if ($results_num === 0) {
            return false;
        } else {
            foreach($results as $results_row) {
                $image_set = Functions::getProductImages($results_row['id']);
                foreach($image_set as $images) {
                    $image_id = $images['id'];
                    $image_ext = $images['ext'];
                }
                $returned_results[] = array(
                'id' 				=> $results_row['id'],
                'title' 			=> $results_row['title'],
                'item_condition' 	=> $results_row['item_condition'],
                'category' 			=> $results_row['category'],
                'item_address' 		=> $results_row['item_address'],
                'description' 		=> $results_row['description'],
                'sale_status' 		=> $results_row['sale_status'],
                'item_contact_number' 	=> $results_row['item_contact_number'],
                'state' 			=> $results_row['state'],
                'price' 			=> $results_row['price'],
                'display' 			=> $results_row['display'],
                'full_name'			=> $results_row['full_name'],
                'image_id' 			=> $results_row['display'],
                'ext' 				=> $results_row['ext']
                );
            }
            return $returned_results;
        }
    }

    public static function deleteProperty($id){
        $id = (int) $id;
        $product_images = self::getProductImages($id);
        foreach($product_images as $image){
            self::deleteImageFromProperty($image['id'], $image['product_id'], $image['ext']);
            Products::deleteProduct($id);
        }
    }

    public static function getProductImages($product_id){
        $result_set = Images::getProductImages($product_id);
        return ($result_set) ? $result_set : false ;
    }  

    public static function deleteImageFromProperty($id, $product_id, $ext) {
        $id = (int)$id;
        $deleted = unlink("{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/uploads/". $product_id .'/'. $id .'.'. $ext);
        if($deleted){
            $deleted_from_db = Images::deleteImage($id);
        }
        
    }


    public static function uploadImage($product_id, $image_temp, $image_ext){
        $result_set = Images::uploadImage($product_id, $image_temp, $image_ext);
        return ($result_set) ? $result_set : false ;
    }  

    public static function sendNotification($new_req_id, $title, $sender_name, $body, $receiver_id=0){
        $result_set = Notifications::sendNotification($new_req_id, $title, $sender_name, $body, $receiver_id);
        return ($result_set) ? $result_set : false ;
    }


    public static function deleteNotification($notification_id){
        $result_set = Notifications::deleteNotification($notification_id);
        return ($result_set) ? $result_set : false ;
    }


    public static function getAllRequests($limit = ""){
        $result_set = PlaceRequest::getAllRequests($limit);
        return ($result_set) ? $result_set : false ;
    } 


    public static function getAllRequestsAdmin($limit = ""){
        $result_set = PlaceRequest::getAllRequestsAdmin($limit);
        return ($result_set) ? $result_set : false ;
    } 

    public static function getPendingRequests($is_admin){
        $result_set = PlaceRequest::getPendingRequests($is_admin);
        return ($result_set) ? $result_set : false ;
    } 

    public static function getMyRequests($is_admin){
        $result_set = PlaceRequest::getMyRequests($is_admin);
        return ($result_set) ? $result_set : false ;
    } 

    public static function getRequestById($id, $is_admin){
        $result_set = PlaceRequest::getRequestById($id, $is_admin);
        return ($result_set) ? $result_set : false ;
    } 

    public static function deleteRequest($id){
        $result_set = PlaceRequest::deleteRequest($id);
        return ($result_set) ? $result_set : false ;
    } 

    public static function approveRequest($id){
        $result_set = PlaceRequest::approveRequest($id);
        return ($result_set) ? $result_set : false ;
    }

    public static function getUnapprovedRequests(){
        $result_set = PlaceRequest::getUnapprovedRequests();
        return ($result_set) ? $result_set : false ;
    }

    public static function getResolvedRequests(){
        $result_set = PlaceRequest::getResolvedRequests();
        return ($result_set) ? $result_set : false ;
    }

    public static function getLastRequestId(){
        $result_set = PlaceRequest::getLastRequestId();
        return ($result_set) ? $result_set : false ;
    }

    public static function checkIfRequestBelongsToUser($id,$user_id = NULL){
        $result_set = PlaceRequest::checkIfRequestBelongsToUser($id,$user_id);
        return ($result_set) ? $result_set : false ;
    }

    public static function getNotificationMessages(){
        $result_set = Notifications::getNotificationMessages();
        return ($result_set) ? $result_set : false ;
    } 

    public static function getRequestImage($id){
        $result_set = PlaceRequest::getRequestImage($id);
        return ($result_set) ? $result_set : false ;
    } 

    public static function checkIfEmailExists($email){
        $result_set = Users::checkIfEmailExists($email);
        return ($result_set) ? $result_set : false ;
    }

    public static function logUserIn($email,$password){
        $result_set = Users::logIn($email,$password);
        return ($result_set) ? $result_set : false ;
    }

    public static function getAllUsers(){
        $result_set = Users::getAllUsers();
        return ($result_set) ? $result_set : false ;
    }

    

    public static function checkIfUserIsAdmin(){
        $result_set = Users::checkIfUserIsAdmin();
        return ($result_set) ? $result_set : false ;
    }

    public static function redirectIfNotAdmin($route = ""){
        $is_admin = Users::checkIfUserIsAdmin();
        if(!$is_admin){
            Functions::redirectTo($route);
        }
    }

    public static function getUserById($id){
        $result_set = Users::getUserById($id);
        return ($result_set) ? $result_set : false ;
    }


    public static function adminDeleteUser($id){
        $result_set = Users::adminDeleteUser($id);
        return ($result_set) ? $result_set : false ;
    }

    public static function deleteUser(){
        $result_set = Users::deleteUser();
        return ($result_set) ? $result_set : false ;
    }

    public static function confirmPassword($password){
        $user = Functions::getUserById($_SESSION['user']['id']);
        if(Functions::passwordVerify($password, $user["hashed_password"])) {
            return true;
        }else {
            return false;
        }
    }

    public static function updateUser($full_name, $email, $phone, $address){
        $result_set = Users::updateUser($full_name, $email, $phone, $address);
        return ($result_set) ? $result_set : false ;
    }

    public static function updatePassword($hashed_password){
        $result_set = Users::updatePassword($hashed_password);
        return ($result_set) ? $result_set : false ;
    }


    public static function updatePasswordRecovery($hashed_password, $email){
        $result_set = Users::updatePasswordRecovery($hashed_password, $email);
        return ($result_set) ? $result_set : false ;
    }

    public static function changeProfileImage($file_temp, $file_extn){
        $file_name = substr(md5(time()), 0, 10) . '.' . $file_extn;
	    $file_path = "{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/profile/" . $file_name;
	    $moved = move_uploaded_file($file_temp, $file_path);
        if($moved){
            $result_set = Users::changeProfileImage($file_name);
        }else{
            $result_set = NULL;
        }
        
        return ($result_set) ? $result_set : false ;
    }


    public static function getNumberOfUnreadMessages($user_id){
        $result_set = Messages::getNumberOfUnreadMessages($user_id);
        return ($result_set) ? $result_set : false ;
    }

    public static function sendMessage($email = "", $recv_id, $subject, $body, $prod_id, $reply_id = 0){
        $saved = Messages::sendMessage($email, $recv_id, $subject, $body, $prod_id, $reply_id);
        if($saved[0]){
            $new_msg_id = $saved[1];
            if($recv_id != 0) {
                $subject = 'Re:' . $subject;
            }
            $notificiationSent = Functions::sendNotification($new_msg_id, "New Message", $_SESSION['user']['full_name'], $subject, $recv_id);
            if($notificiationSent){
                $savedSecond = Functions::sendMessage($email, $recv_id, $subject, $body, $prod_id, $reply_id);
                return $savedSecond[0];
            }
        }else{
            return false;
        }
    }

    public static function getMyMessages($msg_stat="", $draft = 0){
        $result_set = Messages::getMyMessages($msg_stat,$draft);
        return ($result_set) ? $result_set : false ;
    }

    public static function getRelatedMessages($id){
        $result_set = Messages::getRelatedMessages($id);
        return ($result_set) ? $result_set : false ;
    }

    public static function getMessagesById($id){
        $result_set = Messages::getMessagesById($id);
        return ($result_set) ? $result_set : false ;
    }

    public static function setMessagesRead($id){
        $result_set = Messages::setMessagesRead($id);
        return ($result_set) ? $result_set : false ;
    }

    public static function getAllNotifications(){
        $result_set = Notifications::getAllNotifications();
        return ($result_set) ? $result_set : false ;
    }

    public static function sugExact($group = false,$id,$product_group,$product_category,&$title,&$similar,&$found,&$lft,&$tot_sug){
        $country = self::getGeoInformation("country");
        $criteria_name = 'category';
        $criteria_value = $product_category;
        if($group) {
            $criteria_name = 'item_group';
            $criteria_value = $product_group;
        }
        $result_set = Products::getSameProductTitles($title,$criteria_name,$criteria_value,$country);
        $count = count($result_set);
        if ($count > 0) {
            foreach($result_set as $similar_product) {
                if($similar_product['id'] != $id) {
                    $similar[] = array(
                        'id' => $similar_product['id'],
                        'title' => $similar_product['title'],
                        'item_group' => $similar_product['item_group'],
                        'category' => $similar_product['category']
                    );
                }
            }   
        }
        $similar = array_intersect_key($similar, array_unique(array_map("serialize", $similar)));

        $found = count($similar);
        $lft = $tot_sug - $found;

        if($found > 2) {
            $similar = array_slice($similar, 0 , 2);
        } 
    }

    public static function titleSplit($group = false,$id,$product_group,$product_category,&$title,&$similar,&$found,&$lft,&$tot_sug){
        $country = self::getGeoInformation("country");
        $criteria_name = 'category';
        $criteria_value = $product_category;
        if($group) {
            $criteria_name = 'item_group';
            $criteria_value = $product_group;
        }
        $title_array = explode(" ", $title);
        usort($title_array, function ($a, $b) {
            return strlen($b)-strlen($a);
        });


        foreach ($title_array as $product_title) {
            $result_set = Products::getSimilarProductTitlesRegex($product_title,$criteria_name,$criteria_value,$country);
            foreach($result_set as $similar_product) {
                if($similar_product['id'] != $id) {
                    
                    $skip_keys = array_keys(array_combine(array_keys($similar), array_column($similar, 'id')), $similar_product['id']);
                    
                    if(!empty($skip_keys)) {
                        continue;
                    }

                    $similar[] = array(
                        'id' => $similar_product['id'],
                        'title' => $similar_product['title'],
                        'item_group' => $similar_product['item_group'],
                        'category' => $similar_product['category']
                    );

                }
            }
        }


        $found = count($similar);

        if($found > 2) {
            $similar = array_slice($similar, 0 , 2);
        }

        $lft = $tot_sug - $found;
    }

    public static function sugRgExact($group = false,$id,$product_group,$product_category,&$title,&$similar,&$found,&$lft,&$tot_sug){
        $country = self::getGeoInformation("country");
        $criteria_name = 'category';
        $criteria_value = $product_category;
        if($group) {
            $criteria_name = 'item_group';
            $criteria_value = $product_group;
        }
        $result_set = Products::getSimilarProductTitles($title,$criteria_name,$criteria_value,$country);
        $count = count($result_set);

        if ($count > 2) {
            foreach($result_set as $similar_product) {
                if($similar_product['id'] != $id) {
                    $similar[] = array(
                        'id' => $similar_product['id'],
                        'title' => $similar_product['title'],
                        'item_group' => $similar_product['item_group'],
                        'category' => $similar_product['category']
                    );
                }
            }   
        }
        $similar = array_intersect_key($similar, array_unique(array_map("serialize", $similar)));
        
        $found = count($similar);

        if($found > 2) {
            $similar = array_slice($similar, 0 , 2);
        }

        $lft = $tot_sug - $found;
    }
    
    public static function saveTemporaryPassword($email,$key,$expDate){
        $result_set = PasswordResetTemp::saveTemporaryPassword($email,$key,$expDate);
        return ($result_set) ? $result_set : false ;
    }

    public static function checkIfResetKeyExists($key, $email){
        $result_set = PasswordResetTemp::checkIfResetKeyExists($key, $email);
        return ($result_set) ? $result_set : false ;
    }

    public static function deleteTemporaryPassword($email){
        $result_set = PasswordResetTemp::deleteTemporaryPassword($email);
        return ($result_set) ? $result_set : false ;
    }

    public static function getGeoInformation($parameter){
        return getGeoInformation($parameter);
    }
    public static function getSessionMesssage(){
        return getSessionMesssage();
    }
    
    public static function checkIfUserIsLoggedIn(){
        return isset($_SESSION['user']['id']);
    }

    public static function redirectIfNotLoggedIn($route){
        if(!isset($_SESSION['user']['id'])){
            Functions::redirectTo($route);
        }
    }

    public static function redirect($link){
        header("Location:{$link}");
    }

    public static function redirectTo($route=""){
        header("Location:".self::getPageUrl()."/{$route}");
    }

    public static function getPageUrl($route=""){
        $page = new PageBuilder;
        return $page->link.$route;
    }
    public static function getBackendAssetsLink(){
        $page = new PageBuilder;
        return $page->link."/vensle-assets/backend";
    }
    public static function getRouteLink(){
        $page = new PageBuilder;
        return $page->link."/";
    }

    public static function checkIfUserHasPicture(){
        return isset($_SESSION['user']['profile_img']);
    }

    public static function checkIfParametersEmpty($required_fields){
        global $errors;
        foreach($required_fields as $field) {
            $value = trim($_POST[$field]);
            if(!self::isEmpty($value)) {
                $errors[$field] = self::fieldnameAsText($field). " can't be blank";
            }
        }

    }
   

    public static function isEmpty($value){
        return isset($value) && $value !== "";
    }

    public static function fieldnameAsText($field_name) {
        $field_name = str_replace("_", " ", $field_name);
        $field_name = ucfirst($field_name);
        return $field_name;
    }

    public static function validateMaxLengths($fields_with_max_lengths){
        global $errors;
        foreach ($fields_with_max_lengths as $field => $max) {
            $value = trim($_POST[$field]);
            if(!self::hasMaxLength($value, $max)) {
                $errors[$field] = self::fieldnameAsText($field)." is too long";
            }
        }
    }

    public static function hasMaxLength($value, $max) {
        return strlen($value) <= $max;
    }

    public static function encryptPassword($password){
        $hash_format = "$2y$10$";
        $salt_length = 22;
        $salt = self::generateSalt($salt_length);
        $format_and_salt = $hash_format . $salt;
        $hash = crypt($password, $format_and_salt);
        return $hash;
    }

    public static function generateSalt($length) {
        $unique_random_string = md5(uniqid(mt_rand(), true));
        $base64_sting = base64_encode($unique_random_string);
        $modified_base64_string = str_replace('+', '.', $base64_sting);
        $salt = substr($modified_base64_string, 0, $length);
        return $salt;
    }

    public static function passwordVerify($password, $existing_hash) {
        $hash = crypt($password, $existing_hash);
        if ($hash === $existing_hash) {
            return true;
        } else {
            return false;
        }
    }

    public static function addError($key,$message){
        global $errors;
        $errors[$key] = $message;
    }

    public static function getResponseMessages(){
        $output = "";
        if(isset($_SESSION["message"])) {
            $output = "<div class='col-md-12' style='background:lightgreen; border-radius:4px; '><p style='color: black; text-align:center;'><span>". htmlentities($_SESSION["message"]). "</span></p></div>";
            $_SESSION["message"] = null;
        }
        return $output;
    }
    public static function getFormErrors($errors=[]){
        if(empty($errors)){
            global $errors;
        }
        $output = "";
        if(!empty($errors)) {
            $output = '<div class="alert alert-error alert-bg alert-block alert-inline ">
                 <h4 class="alert-title">
                     <i class="w-icon-exclamation-triangle"></i>Oh snap!</h4>
                 Change a few things up and try submitting again.
                 <ul>
                    ';
            $output .= '<ul class="error_msg">';
            foreach ($errors as $key => $error) {
                $output .= "<li>{$error}</li>";
            }
            $output .= '</ul>
            <button class="btn btn-link btn-close" aria-label="button">
                     <i class="close-icon"></i>
                 </button></div>';
        }
        return $output;
    }
    
    public static function loadView($view_file,PageBuilder $pageObject){
        // ob_start();
        // var_dump($pageObject);
        // $pageObject->body = include "src/Views/{$view_file}";
        // $pageObject->body = include "src/Views/homenav.php";
        // var_dump($pageObject);
        // $page = ob_get_clean();
        // var_dump($page);
        // die("lskds");
        // return $page;
    }
}