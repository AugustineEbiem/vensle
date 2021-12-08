<?php
namespace Models;
class PlaceRequest extends Model{

    private $db;
    public $user_id;
    public $title;
    public $item_condition;
    public $category;
    public $item_group;
    public $item_address;
    public $description;
    public $price;
    public $sale_status;
    public $item_contact_number;
    public $upload_date;
    public $state;
    public $min_price;
    public $max_price;
    public $file_name;
    public $ref_no;
    public $date_sent;
    public $resolved;


    public function __construct(){
        $this->db = parent::getConnection();
    }


    public function save(){
        $sql = "INSERT INTO place_request(user_id, title, item_condition, category, item_group, item_address,display, description, state, min_price, max_price, ref_no, country, item_contact_number, resolved, date_sent, date_resolved)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)";
        $prepared = $this->db->prepare($sql);
        $executed = $prepared->execute([$this->user_id, $this->title, $this->item_condition, $this->category,$this->item_group, $this->item_address, $this->display, $this->description, $this->state,$this->min_price,$this->max_price,$this->ref_no,$this->country, $this->item_contact_number, $this->resolved, $this->date_sent, $this->date_sent]);
        return [$executed,$this->db->lastInsertId()];
    }

    public static function getAllRequests($limit = ""){
        $limit_string = "";
        if($limit != "") {
            $limit_string = " LIMIT ".$limit;
        }
	    $sql = "SELECT `place_request`.`id`,`place_request`.`approved`, `place_request`.`user_id`, `place_request`.`title`, `place_request`.`item_condition`, `place_request`.`item_group`, `place_request`.`display`, `place_request`.`category`, `place_request`.`item_address`, `place_request`.`state`, `place_request`.`item_contact_number`, `place_request`.`min_price`, `place_request`.`max_price`, `place_request`.`description`, `place_request`.`date_sent`, `users`.`full_name`, `item_category`.`name` as `category_name` FROM `place_request`  LEFT JOIN `users` ON `place_request`.`user_id`=`users`.`id` LEFT JOIN `item_category` ON  `place_request`.`category` = `item_category`.`id` WHERE `place_request`.`approved`= 1 ORDER BY `place_request`.`date_sent` DESC". $limit_string;
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }
    public static function getAllRequestsAdmin($limit = ""){
        $limit_string = "";
        if($limit != "") {
            $limit_string = " LIMIT ".$limit;
        }
	    $sql = "SELECT `place_request`.`id`,`place_request`.`approved`, `place_request`.`user_id`, `place_request`.`title`, `place_request`.`item_condition`, `place_request`.`item_group`, `place_request`.`display`, `place_request`.`category`, `place_request`.`item_address`, `place_request`.`state`, `place_request`.`item_contact_number`, `place_request`.`min_price`, `place_request`.`max_price`, `place_request`.`description`, `place_request`.`date_sent`, `users`.`full_name`, `item_category`.`name` as `category_name` FROM `place_request`  LEFT JOIN `users` ON `place_request`.`user_id`=`users`.`id` LEFT JOIN `item_category` ON  `place_request`.`category` = `item_category`.`id` ORDER BY `place_request`.`date_sent` DESC". $limit_string;
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }
    public static function getPendingRequests($is_admin){
        $str = "";
        if(!$is_admin) {
            $str = " AND user_id = " . $_SESSION['user']['id'];
        }
        $sql = "SELECT `place_request`.`id`,`place_request`.`approved`, `place_request`.`user_id`,  `place_request`.`title`, `place_request`.`item_condition`, `place_request`.`item_group`, `place_request`.`display`, `place_request`.`category`, `place_request`.`item_address`, `place_request`.`state`, `place_request`.`item_contact_number`, `place_request`.`min_price`, `place_request`.`max_price`, `place_request`.`ref_no`, `place_request`.`description`, `place_request`.`date_sent`, `users`.`full_name`, `item_category`.`name` as `category_name` FROM `place_request`  LEFT JOIN `users` ON `place_request`.`user_id`=`users`.`id` LEFT JOIN `item_category` ON  `place_request`.`category` = `item_category`.`id` WHERE `place_request`.`approved`= 0 {$str} ORDER BY `place_request`.`date_sent` DESC";
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }
    public static function getMyRequests($is_admin){
        $str = "";
        if(!$is_admin) {
            $str = " WHERE `place_request`.`user_id` =  ". $_SESSION['user']['id'];
        }
        $sql = "SELECT `place_request`.`id`, `place_request`.`title`, `place_request`.`item_condition`, `place_request`.`category`, `place_request`.`item_address`, `place_request`.`approved`, LEFT(`place_request`.`description`, 70) as `description`, `place_request`.`ref_no`, `place_request`.`item_contact_number`, `place_request`.`state`, `place_request`.`min_price`, `place_request`.`max_price`, `place_request`.`resolved`, `place_request`.`display`, `place_request`.`date_sent`, `users`.`full_name`, `item_category`.`name` as `category_name` FROM `place_request` LEFT JOIN `users` ON `place_request`.`user_id` = `users`.`id` LEFT JOIN `item_category` ON `place_request`.`category` = `item_category`.`id` {$str} ORDER BY `place_request`.`date_sent` DESC";
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }
    public static function getUnapprovedRequests(){
        $sql = "SELECT * FROM place_request WHERE user_id = ? AND approved = 0";
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $prepared->execute([$_SESSION['user']['id']]);
        $data = $prepared->fetchAll();
        return $data;
    }

    public static function getResolvedRequests(){
        $sql = "SELECT * FROM place_request WHERE user_id = ? AND resolved = 1";
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $prepared->execute([$_SESSION['user']['id']]);
        $data = $prepared->fetchAll();
        return $data;
    }
    public static function getRequestImage($id){
        $db = parent::getConnection();
        $sql = "SELECT display FROM place_request WHERE id = ?";
        $prepared = $db->prepare($sql);
        $prepared->execute([$id]);
        $data = $prepared->fetchAll();
        return $data;
    }

    public static function getLastRequestId(){
        $db = parent::getConnection();
        $sql = "SELECT id FROM place_request ORDER BY id DESC LIMIT 1";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetch();
        return $data++;
    }

    public static function checkIfRequestBelongsToUser($id,$user_id){
        $db = parent::getConnection();
        $id = (int)$id;
        $user_id = isset($user_id) ? $user_id : $_SESSION["user"]["id"];
        $sql = "SELECT * FROM place_request WHERE id = ? AND user_id = ?";
        $prepared = $db->prepare($sql);
        $prepared->execute([$id,$user_id]);
        $output = $prepared->fetchAll();
        return $output;
    }

    public static function getRequestById($id, $admin){
        $db = parent::getConnection();
        $mine_str = "";
        if(!$admin) {
            $mine_str = " AND user_id = " . $_SESSION['user']['id'];
        }
        $sql = "SELECT * FROM place_request WHERE id = ?" . $mine_str ." LIMIT 1";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$id]);
    }

    public static function deleteRequest($id){
        $db = parent::getConnection();
        $mine_str = "";
        (int) $id;
        $sql = "DELETE FROM place_request WHERE id = ?";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$id]);
    }

    public static function approveRequest($id){
        $db = parent::getConnection();
        $sql = "UPDATE place_request SET `approved` = 1 WHERE id = ?";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$id]);
    }

}
                