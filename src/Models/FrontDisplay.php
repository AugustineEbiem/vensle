<?php
namespace Models;
class FrontDisplay extends Model{
    public static function getCategory($cat_id){
        $db = parent::getConnection();
        $sql = "SELECT * FROM front_display WHERE id =  ? LIMIT 1";
        $prepared = $db->prepare($sql);
        $prepared->execute([$cat_id]);
        return $prepared->fetch();
    }
    public static function getAllCategories(){
        $db = parent::getConnection();
        $sql = "SELECT * FROM front_display";
        $prepared = $db->prepare($sql);
        $prepared->execute([]);
        return $prepared->fetchAll();
    }

    public static function updateCategoryImage($image1,$image2,$image3,$image4,$cat_id){
        $db = parent::getConnection();
        $sql = "UPDATE front_display SET image_1 = ?, image_2 = ?, image_3 = ?, image_4 = ? WHERE id = ?";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$image1, $image2, $image3, $image4, $cat_id]);
    }
}
                