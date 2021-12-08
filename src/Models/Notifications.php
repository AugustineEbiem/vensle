<?php
namespace Models;
class Notifications extends Model{
    public static function getUserRequests(){
        $db = parent::getConnection();
        $sql = "SELECT * FROM notifications WHERE sender_id != " . $_SESSION['user']['id']. " AND title = 'Request Sent' ORDER BY date_sent DESC";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }
    public static function getNotificationMessages(){
        $db = parent::getConnection();
        $sql = "SELECT `notifications`.`id`, `notifications`.`request_id`, `notifications`.`sender_id`, `notifications`.`receiver_id`, `notifications`.`title`, `notifications`.`sender_name`, `notifications`.`body`, `notifications`.`viewed`, `notifications`.`date_sent`, `users`.`profile_img` FROM notifications LEFT JOIN `users` ON `notifications`.`sender_id`=`users`.`id` WHERE receiver_id = " .$_SESSION['user']['id']. " AND title = 'New Message' AND viewed = 0 ORDER BY `notifications`.`date_sent` DESC";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }
    public static function getAllNotifications(){
        $db = parent::getConnection();
        $sql = "SELECT * FROM notifications WHERE title !='New Message' AND viewed=0 ORDER BY date_sent DESC";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }

    public static function sendNotification($new_req_id, $title, $sender_name, $body, $receiver_id=0){
        $date_sent = date('Y-m-d H:i:s');
        $sender_id = (isset($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : 0 ;
        $receiver_id = (int)$receiver_id;
        $db = parent::getConnection();
        $sql = "INSERT INTO notifications(request_id, sender_id, receiver_id, title, sender_name, body, viewed, date_sent) VALUES(?,?,?,?,?,?,?,?)";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$new_req_id, $sender_id, $receiver_id, $title, $sender_name, $body, 0, $date_sent]);
    }

    public static function deleteNotification($notification_id){
        $db = parent::getConnection();
        $sql = "DELETE FROM notifications WHERE id =  ?";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$notification_id]);
    }
}