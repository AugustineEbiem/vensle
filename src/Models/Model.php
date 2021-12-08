<?php
namespace Models;
use Models\Functions;
class Model{
    public static function getConnection(){
        return getDb();
    }
    public static function getGeoInformation($parameter){
        return Functions::getGeoInformation($parameter);
    }
}