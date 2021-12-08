<?php
namespace Models;
class ItemGroup extends Model{
    public static function getGroups($active){
        $db = parent::getConnection();
        $str = "";
        if($active) {
            $str = " WHERE active = 1";
        }
        $sql = "SELECT * FROM item_group ".$str;
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;
    }
}