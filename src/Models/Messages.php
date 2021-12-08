<?php
namespace Models;
class Messages extends Model{
    public static function getNumberOfUnreadMessages($user_id){
        $sql = "SELECT COUNT(*) FROM messages WHERE receiver = ? AND msg_read = 0 AND draft = 0";
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $prepared->execute([$user_id]);
        $data = $prepared->fetch()[0];
        return $data;
    }
    public static function sendMessage($email = "", $recv_id, $subject, $body, $prod_id, $reply_id = 0){
        if($email == "") {
            $sender = $_SESSION['user']['id'];
        }
        $prod_id = (int)$prod_id;
        $recv_id = (int)$recv_id;
        $msg_read = 0;
        $sent_date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO messages(sender, receiver, subject, body, product_id, reply_id, msg_read, sent_date, other) VALUES(?, ?, ? , ?, ?, ?, ?, ?,?)";
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $executed = $prepared->execute([0, $recv_id, $subject, $body, $prod_id, $reply_id, $msg_read, $sent_date, $sender]);
        return [$executed, $db->lastInsertId()];
    }
    public static function getMyMessages($msg_stat="", $draft = 0){
        $prn_str = "receiver = " . $_SESSION['user']['id'];
        if($msg_stat == 'sent') {
            $prn_str = "sender = " . $_SESSION['user']['id'];
        }
        $sql = "SELECT `messages`.`id`, `messages`.`person`, `messages`.`sender`, `messages`.`receiver`, `messages`.`subject`, `messages`.`body`, `messages`.`product_id`, `messages`.`reply_id`, `messages`.`draft`, `messages`.`msg_read`, `messages`.`sent_date`, `messages`.`other`, `users`.`full_name` FROM messages LEFT JOIN `users` ON `messages`.`other`=`users`.`id` WHERE {$prn_str} AND draft = ". $draft ." ORDER BY sent_date DESC";
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $prepared->execute([]);
        return $prepared->fetchAll();
    }

    public static function getDraftMessages(){
        $sql = "SELECT * FROM messages WHERE sender = ".$_SESSION['user']['id']." AND draft= 1 ORDER BY sent_date DESC";
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $executed = $prepared->execute();
        return $prepared->fetchAll();
    }

    public static function getRelatedMessages($id){
        $sql = "SELECT * FROM messages WHERE (sender = ". $_SESSION['user']['id'] ." OR receiver = ". $_SESSION['user']['id'] .") AND id = ". $id ." ORDER BY sent_date DESC";
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $executed = $prepared->execute();
        return $prepared->fetchAll();
    }


    public static function getMessagesById($id){
        $sql = "SELECT `messages`.`id`, `messages`.`person`, `messages`.`sender`, `messages`.`receiver`, `messages`.`subject`, `messages`.`body`, `messages`.`product_id`, `messages`.`reply_id`, `messages`.`draft`, `messages`.`msg_read`, `messages`.`sent_date`, `messages`.`other`, `users`.`full_name`, `users`.`profile_img` FROM messages LEFT JOIN `users` ON `messages`.`other`=`users`.`id` WHERE `messages`.`id` = " . $id . " LIMIT 1";
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        $executed = $prepared->execute();
        return $prepared->fetch();
    }


    public static function setMessagesRead($id){
        $sql = "UPDATE messages SET msg_read = 1 WHERE id = " . $id;
        $db = parent::getConnection();
        $prepared = $db->prepare($sql);
        return $prepared->execute();
        
    }

}
                