<?php
/**
 * Created by PhpStorm.
 * User: scaryken
 * Date: 2017/4/30
 * Time: 16:15
 */

namespace utils;


class Tools
{
    public static function isValidId($id){
        return is_numeric($id) && ($id > 0) && (floor($id) == $id);
    }

}