<?php
namespace Models;
class ItemCategory extends Model{
    public static function getCategoriesByGroup($group_id,$active = true){
        $db = parent::getConnection();
        $group_id = (int)$group_id;
        $str = "";
        if($active) {
            $str = "WHERE active = 1";
        }
        $sql = "SELECT * FROM item_category " . $str . " AND item_group = " . $group_id . " ORDER BY name ASC";
        $prepared = $db->prepare($sql);
        $prepared->execute();
        $data = $prepared->fetchAll();
        return $data;

    }
}
                