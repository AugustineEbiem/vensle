<?php
namespace Models;

use Intervention\Image\ImageManager;


class Images extends Model{
    public static function getProductImages($product_id){
        $db = parent::getConnection();
        $sql = "SELECT * FROM images WHERE product_id = ?";
        $prepared = $db->prepare($sql);
        $prepared->execute([$product_id]);
        $data = $prepared->fetchAll();
        return $data;
    }

    public static function uploadImage($product_id, $image_temp, $image_ext){
        $manager = new ImageManager(array('driver' => 'gd'));
        $timestamp = date('Y-m-d H:i:s');
        $db = parent::getConnection();
        $sql = "INSERT INTO images(product_id, request_id, date_time, ext) VALUES(?,?,?,?)";
        $prepared = $db->prepare($sql);
        $executed = $prepared->execute([$product_id,0,$timestamp,$image_ext]);
        if($executed){
            $image_id = $db->lastInsertId();
            $image_file = $image_id.'.'.$image_ext;
            //save image to server
	        $moved = move_uploaded_file($image_temp, "{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/uploads/{$product_id}/{$image_file}");

            // create new image from saved product image on server directory
            $image = $manager->make("{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/uploads/{$product_id}/{$image_file}");

            $width = $image->width();
            $height = $image->height();
            if ($width > 500 || $height > 450 ) {
                $image->resize($width/2,$height/2);
            }elseif ($width > 1000 || $height > 900 ) {
                $image->resize($width/4,$height/4);
            }
            elseif ($width > 1500 || $height > 1500 ) {
                $image->resize($width/6,$height/6);
            }elseif ($width > 2000 || $height > 1800 ) {
                $image->resize($width/8,$height/8);
            }else{
                $image->resize($width/2,$height/2);
            }

            $image->save("{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/uploads/{$product_id}/new_{$image_file}",80);
            Images::make_thumbnail($product_id,$image_id,$image_ext);
        }
        return $db->lastInsertId();
    }

    public static function deleteImage($id){
        $db = parent::getConnection();
        $sql = "DELETE FROM `images` WHERE id = ? ";
        $prepared = $db->prepare($sql);
        return $prepared->execute([$id]);	
    }

    public static function make_thumbnail($product_id,$image_id,$image_ext){
            $image_file = $image_id.'.'.$image_ext;
            $manager = new ImageManager(array('driver' => 'gd'));

            $image = $manager->make("{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/uploads/".$product_id .'/'. $image_file);
            $width = $image->width();
            $height = $image->height();
            if ($width > 400 || $height > 400 ) {
                $image->resize($width/4,$height/4);
            }elseif ($width > 900 || $height > 900 ) {
                $image->resize($width/8,$height/8);
            }
            elseif ($width > 1500 || $height > 1500 ) {
                $image->resize($width/12,$height/12);
            }else{
                $image->resize($width/2,$height/2);
            }

            $image->save("{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/uploads/{$product_id}/thumb_{$image_file}",80);
            $image->save("{$_SERVER['DOCUMENT_ROOT']}/vensle-assets/backend/images/uploads/{$product_id}/thumb_{$image_file}",80);
    }
}
                