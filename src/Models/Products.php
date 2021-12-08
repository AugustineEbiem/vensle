<?php
namespace Models;
class Products extends Model{
    public $user_id;
    public $title;
    public $item_condition;
    public $category;
    public $item_group;
    public $item_address;
    public $location;
    public $description;
    public $price;
    public $currency;
    public $sale_status;
    public $item_contact_number;
    public $upload_date;
    public $country;
    private $db;

    public function __construct(){
        $this->db = parent::getConnection();
    }


    public function save(){
        $sql = "INSERT INTO `products`(`user_id`, `title`, `item_condition`, `category`, `item_group`, `item_address`, `description`, `state`, `country`, `price`, `currency`, `sale_status`, `item_contact_number`, `upload_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        $prepared = $this->db->prepare($sql);
        $executed = $prepared->execute([$this->user_id, $this->title, $this->item_condition, $this->category,$this->item_group,$this->item_address,$this->description,$this->location,$this->country,$this->price,$this->currency,$this->sale_status,$this->item_contact_number,$this->upload_date]);
        return [$executed,$this->db->lastInsertId()];
    }

    public static function search($keywords, $item_group_id, $home_cat=false, $item_state = '', $min_price = 0, $max_price = 0, $sort = ''){
        $state_str = "";
        $sort_str = "";
        $range_str = "";
        $group_str = "";
        if($sort == 'asc') {
            $sort_str = " ORDER BY `products`.`price` ASC";
        }else if($sort == 'desc') {
            $sort_str = " ORDER BY `products`.`price` DESC";
        }
        if($item_state != '') {
            $state_str = " AND `products`.`state` = '".$item_state."'";
        }	
        if($min_price > 0 && $max_price == false) {
            $range_str = " AND `products`.`price` >= " . $min_price;
        }elseif($max_price > 0 && $min_price == false) {
            $range_str = " AND `products`.`price` <= " . $max_price;
        }elseif($min_price > 0 && $max_price > 0) {
            $range_str = " AND `products`.`price` >= ". $min_price ." AND `products`.`price` <= " . $max_price;
        }
        $image_id = null;
        $image_ext = null;	
        $returned_results = array();
        $where = "";
        $keywords = preg_split('/[\s]+/', $keywords);
        $total_keywords = count($keywords);
        if($item_group_id != "") {
            $group_str = " AND `products`.`item_group` = ".$item_group_id;
        }
        if($home_cat == false) {
            foreach ($keywords as $key => $keyword) {
                $where .= "(`title` LIKE '%$keyword%' OR `description` LIKE '%$keyword%' OR `state` LIKE '%$keyword%')";
                if($key != ($total_keywords - 1)) {
                    $where .= " OR ";
                }
            }
        }else {
            $where = " `products`.`item_group` = " . $home_cat;
        }
        $db  = parent::getConnection();
        $sql =  "SELECT `products`.`id`, `products`.`title`, `products`.`item_condition`, `products`.`category`, `products`.`item_address`, `products`.`description`, `products`.`sale_status`, `products`.`item_contact_number`, `products`.`state`, `products`.`price`, `products`.`display`, `images`.`ext`, `users`.`full_name` FROM `products` LEFT JOIN `images` ON `products`.`display` = `images`.`id` LEFT JOIN `users` ON `products`.`user_id` = `users`.`id` WHERE ($where)" . $state_str . $group_str . $range_str . " AND `country`='".parent::getGeoInformation("country")."' AND approved=1 AND `products`.`sold`=0" . $sort_str;
        $prepared = $db->prepare($sql);
        $prepared->execute();
        return $prepared->fetchAll();
    }


    public static function getGroupsCategories($name,$value,$country=false,$limit='yes'){
        $db = parent::getConnection();
        if ($country != false) {
            // code...
            $country = '';
        }else{
            $country = "AND `products`.`country`= '".parent::getGeoInformation("country")."'";
        }

        if ($limit == 'yes') {
            $limit_str = "LIMIT 12";
        }
        else{
            $limit_str = '';
        }
        $sql = "SELECT `products`.`id`, `products`.`title`, `products`.`item_condition`, `products`.`category`, `products`.`item_address`, `products`.`description`, `products`.`item_contact_number`, `products`.`state`, `products`.`price`, `products`.`position`, `products`.`country`, `products`.`ref_no`, `products`.`display`, `products`.`upload_date`, `images`.`id` as `image_id`, `images`.`product_id`, `images`.`ext`, `users`.`full_name` FROM `products` LEFT JOIN `images` ON `products`.`display` = `images`.`id` LEFT JOIN `users` ON `products`.`user_id` = `users`.`id` WHERE featured = 1 AND `products`.`" .$name. "` = " .$value. " ". $country ." AND approved=1 AND sold=0 ORDER BY `products`.`position` DESC ".$limit_str;
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }
    public static function checkIfProductBelongsToUser($id,$user_id){
        $db = parent::getConnection();
        $id = (int)$id;
        $user_id = isset($user_id) ? $user_id : $_SESSION["user"]["id"];
        $sql = "SELECT * FROM products WHERE id = ? AND user_id = ?";
        $prepared = $db->prepare($sql);
        $prepared->execute([$id,$user_id]);
        $output = $prepared->fetchAll();
        return $output;
    }
    public static function getProductDetailsById($id,$check_approved){
        $approved = '';
        if($check_approved) {
            $approved = ' AND `products`.`approved`=1';
        }	
        $db = parent::getConnection();
        $sql = "SELECT `products`.`id`, `products`.`user_id`, `products`.`title`, `products`.`item_condition`, `products`.`category`, `products`.`item_group`, `products`.`item_address`, `products`.`item_contact_number`, `products`.`description`, `products`.`ref_no`, `products`.`state`, `products`.`country`, `products`.`price`, `products`.`sold`, `products`.`approved`, `products`.`upload_date`,`images`.`id` as `image_id`, `images`.`product_id`, `images`.`ext`, `users`.`full_name`, `item_category`.`name` as `category_name`, `item_group`.`name` as `group_name` FROM `products` LEFT JOIN `images` ON `products`.`id` = `images`.`product_id` LEFT JOIN `users` ON `products`.`user_id` = `users`.`id` LEFT JOIN `item_category` ON `products`.`category` = `item_category`.`id` LEFT JOIN `item_group` ON `products`.`item_group` = `item_group`.`id` WHERE `products`.`id` = ? " .$approved." GROUP BY `products`.`id` ORDER BY `products`.`id` DESC";
        $prepared = $db->prepare($sql);
        $prepared->execute([$id]);
        $data = $prepared->fetch();
        return $data;
    }
    public static function getAllProducts($sold = 'no', $not_admin = true, $limit = false, $profile_id = false){
        $sold_string = ""; 
        $profile_id = $profile_id;
        if($sold == 'no') {
            $sold_string = "  WHERE `products`.`sold` = 0 ";
        }elseif ($sold == 'yes') {
            $sold_string = "  WHERE `products`.`sold` = 1 ";
        }
        $admin_string = "";
        if($not_admin) {
            $admin_string = " AND `products`.`user_id` = ". $_SESSION['user']['id'];
        }else if($profile_id != false && $profile_id != false) {
            $admin_string = " AND `products`.`user_id` = ".$profile_id;
        }
        $limit_str = "";
        if($limit != false) {
            $limit_str = " LIMIT " . $limit;
        }
        
        $db = parent::getConnection();
        $sql = "SELECT `products`.`id`, `products`.`title`, `products`.`country`, `products`.`item_condition`, `products`.`category`, `products`.`item_address`, LEFT(`products`.`description`, 70) as `description`, `products`.`ref_no`, `products`.`item_contact_number`, `products`.`state`, `products`.`price`, `products`.`approved`, `products`.`display`,`products`.`featured`, `products`.`upload_date`, `images`.`id` as `image_id`, `images`.`product_id`, `images`.`ext`, `users`.`full_name`, `item_category`.`name` as `category_name` FROM `products` LEFT JOIN `images` ON `products`.`display` = `images`.`id` LEFT JOIN `users` ON `products`.`user_id` = `users`.`id` LEFT JOIN `item_category` ON `products`.`category` = `item_category`.`id`" . $sold_string . $admin_string ." ORDER BY `products`.`upload_date` DESC" .$limit_str;
        $prepared = $db->prepare($sql);
        $prepared->execute([]);
        $data = $prepared->fetchAll();
        return $data;
    } 

    public static function getSectionedProducts($sold = 'no', $not_admin = true, $country = false, $group_id,$cat_id=false){
        $sold_string = ""; 
        $profile_id = false;
        
        if($sold == 'no') {
            $sold_string = "  WHERE `products`.`sold` = 0 ";
        }elseif ($sold == 'yes') {
            $sold_string = "  WHERE `products`.`sold` = 1 ";
        }
        $admin_string = "";
        if($not_admin) {
            $admin_string = " AND `products`.`country` = '". $country."' AND `products`.`item_group` ='".$group_id."' ";
        }
        
        
        $db = parent::getConnection();
        echo $sql = "SELECT `products`.`id`, `products`.`title`, `products`.`country`, `products`.`item_condition`, `products`.`category`, `products`.`item_address`, LEFT(`products`.`description`, 70) as `description`, `products`.`ref_no`, `products`.`item_contact_number`, `products`.`state`, `products`.`price`, `products`.`approved`, `products`.`display`,`products`.`featured`, `products`.`upload_date`, `images`.`id` as `image_id`, `images`.`product_id`, `images`.`ext`, `users`.`full_name`, `item_category`.`name` as `category_name` FROM `products` LEFT JOIN `images` ON `products`.`display` = `images`.`id` LEFT JOIN `users` ON `products`.`user_id` = `users`.`id` LEFT JOIN `item_category` ON `products`.`category` = `item_category`.`id`" . $sold_string . $admin_string ." ORDER BY `products`.`upload_date` DESC";
        $prepared = $db->prepare($sql);
        $prepared->execute([]);
        $data = $prepared->fetchAll();
        return $data;
    }

    public static function getPendingProducts($is_admin,$start=false,$limit=false){
        $str = "";
	if(!$is_admin) {
		$str = " AND user_id = " . $_SESSION['user']['id'];
        $limit_str = "";
        if($limit != false) {
            $limit_str = " LIMIT " . $limit;
        }

	}
        $db = parent::getConnection();
        $sql = "SELECT `products`.`id`, `products`.`title`, `products`.`item_condition`, `products`.`category`, `products`.`item_address`, LEFT(`products`.`description`, 10) as `description`, `products`.`ref_no`, `products`.`item_contact_number`, `products`.`state`, `products`.`price`, `products`.`display`, `products`.`upload_date`, `images`.`ext`, `users`.`full_name`, `item_category`.`name` as `category_name` FROM `products` LEFT JOIN `images` ON `products`.`display` = `images`.`id` LEFT JOIN `users` ON `products`.`user_id` = `users`.`id` LEFT JOIN `item_category` ON `products`.`category` = `item_category`.`id` WHERE approved = 0 AND sold = 0" . $str ." ORDER BY `products`.`upload_date` DESC";
        $prepared = $db->prepare($sql);
        $prepared->execute([]);
        $data = $prepared->fetchAll();
        return $data;
    }

    public static function getProductById($id, $sold = false, $mine=false){
        $db = parent::getConnection();
        $sold_string = "";
        $mine_string = "";
        if($sold) {
            $sold_string = " AND sold = 0";
        }
        if($mine) {
            $mine_string = " AND user_id = " . $_SESSION['user']['id'];
        }
        
        $sql = "SELECT * FROM products WHERE id = ? ". $sold_string . $mine_string ." LIMIT 1";
        $prepared = $db->prepare($sql);
        $prepared->execute([$id]);
        $data = $prepared->fetch();
        return $data;
    }


    public static function getAllProductsByUserId($id){
        $db = parent::getConnection();
        $sql = "SELECT * FROM products WHERE user_id = ? ";
        $prepared = $db->prepare($sql);
        $prepared->execute([$id]);
        $data = $prepared->fetchAll();
        return $data;
    }

    public static function getSimilarProductTitles($title,$criteria_name,$criteria_value,$country){
        $db = parent::getConnection();
        $sql = "SELECT * FROM products WHERE title LIKE '%?%' AND ". $criteria_name ." = ? AND `country` = ? AND approved=1 AND sold=0";
        $prepared = $db->prepare($sql);
        $prepared->execute([$title,$criteria_value,$country]);
        $data = $prepared->fetchAll();
        return $data;
    }

    public static function getSameProductTitles($title,$criteria_name,$criteria_value,$country){
        $db = parent::getConnection();
        $sql = "SELECT * FROM products WHERE title = ? AND ". $criteria_name ." = ? AND `country` = ? AND approved=1 AND sold=0";
        $prepared = $db->prepare($sql);
        $prepared->execute([$title,$criteria_value,$country]);
        $data = $prepared->fetchAll();
        return $data;
    }
    public static function getSimilarProductTitlesRegex($product_title,$criteria_name,$criteria_value,$country){
        $db = parent::getConnection();
        $sql = "SELECT * FROM products WHERE title REGEXP '[[:<:]]". $product_title ."[[:>:]]' AND ". $criteria_name ." = " . $criteria_value . " AND `country` = '". $country ."' AND approved=1 AND sold=0";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }

    public static function getUnapprovedProducts(){
        $db = parent::getConnection();
        $sql = "SELECT * FROM products WHERE user_id = {$_SESSION['user']['id']} AND approved = 0";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }
    public static function getUsersProducts(){
        $db = parent::getConnection();
        $sql = "SELECT * FROM products WHERE user_id = {$_SESSION['user']['id']}";
        $sql = "SELECT `products`.`id`, `products`.`title`, `products`.`item_condition`, `products`.`category`, `products`.`item_address`, LEFT(`products`.`description`, 10) as `description`, `products`.`ref_no`, `products`.`item_contact_number`, `products`.`state`, `products`.`price`, `products`.`display`, `products`.`upload_date`, `images`.`ext`, `users`.`full_name`, `item_category`.`name` as `category_name` FROM `products` LEFT JOIN `images` ON `products`.`display` = `images`.`id` LEFT JOIN `users` ON `products`.`user_id` = `users`.`id` LEFT JOIN `item_category` ON `products`.`category` = `item_category`.`id` WHERE `products`.`approved` = 1 AND sold = 0  ORDER BY `products`.`upload_date` DESC";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }

    public static function getFeaturedProducts(){
        $db = parent::getConnection();
        $sql = "SELECT * FROM featured_products ";
        $sql = "SELECT `products`.`id`, `products`.`title`, `products`.`item_condition`, `products`.`category`, `products`.`item_address`, LEFT(`products`.`description`, 70) as `description`, `products`.`ref_no`, `products`.`item_contact_number`, `products`.`state`, `products`.`price`, `products`.`approved`, `products`.`display`, `products`.`upload_date`, `images`.`id` as `image_id`, `images`.`product_id`, `images`.`ext`, `users`.`full_name`, `item_category`.`name` as `category_name` FROM `products` LEFT JOIN `images` ON `products`.`display` = `images`.`id` LEFT JOIN `users` ON `products`.`user_id` = `users`.`id` LEFT JOIN `item_category` ON `products`.`category` = `item_category`.`id` WHERE featured = '1' ORDER BY `products`.`upload_date` DESC";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        return $prepared->fetchAll();
    }

    public static function getNumberOfSoldItems($admin = true){
        $str = "";
        if(!$admin) {
            $str = " AND user_id = " . $_SESSION['user']['id'];
        }
        $db = parent::getConnection();
        $sql = "SELECT SUM(price) as prod_sum FROM products WHERE sold = 1 {$str}";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetch();
        return $data;
    }
    public static function getUserSoldItems($id){
        $str = " AND user_id = " . $id;
        $db = parent::getConnection();
        $sql = "SELECT * FROM products WHERE sold = 1 {$str}";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetch();
        return $data;
    }
    public static function updateProductInformation($latest_img_id,$ref_no,$product_id){
        $db = parent::getConnection();
        $sql = "UPDATE `products` SET `display` = ?, `ref_no` = ? WHERE `id` = ?";
        $prepared = $db->prepare($sql);
        return [$prepared->execute([$latest_img_id,$ref_no,$product_id]),$db->lastInsertId()];
    }

    public static function deleteProduct($id){
        $db = parent::getConnection();
        $sql = "DELETE FROM `products` WHERE `id` = ?";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$id]);
    }

    public static function approveProduct($id){
        $db = parent::getConnection();
        $sql = "UPDATE `products` SET approved = 1 WHERE `id` = ?";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$id]);
    } 

    public static function featureProduct($id){
        $db = parent::getConnection();
        $sql = "UPDATE `products` SET featured = 1 WHERE `id` = ?";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$id]);
    }
    public static function unfeatureProduct($id){
        $db = parent::getConnection();
        $sql = "UPDATE `products` SET featured = 0 WHERE `id` = ?";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$id]);
    }

    public static function setFeaturedProductPosition($product_id,$position){
        $db = parent::getConnection();
        $sql = "UPDATE `products` SET `position` = '$position' WHERE `id` = ".$product_id;
        $prepared = $db->prepare($sql);
        return $prepared->execute();
    }

    public static function frontCategories(){
        $db = parent::getConnection();
        $sql = "SELECT * FROM `front_display`";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return  $data;
    }
    

    public static function getCategoryFeaturedProduct($cat_id){
        $db = parent::getConnection();
        $sql = "SELECT * FROM `featured_products`  LEFT JOIN `products` ON `featured_products`.`prod_id` = `products`.`id` WHERE `featured_products`.`cat_id`=$cat_id";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        return $prepared->fetchAll();

    }



}