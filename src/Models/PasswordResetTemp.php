<?php
namespace Models;
class PasswordResetTemp extends Model{

    public static function saveTemporaryPassword($email,$key,$expDate){
        $db = parent::getConnection();
        $sql = "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES (?, ?, ?)";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$email,$key,$expDate]);
    }


    public static function checkIfResetKeyExists($key, $email){
        $db = parent::getConnection();
        $sql = "SELECT * FROM `password_reset_temp` WHERE `key`= ? AND `email` = ?";
        $prepared = $db->prepare($sql);
        $prepared->execute([$key,$email]);
        return $prepared->fetch();
    }


    public static function deleteTemporaryPassword($email){
        $db = parent::getConnection();
        $sql = "DELETE FROM `password_reset_temp` WHERE  `email` = ?";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$email]);
    }
}
                