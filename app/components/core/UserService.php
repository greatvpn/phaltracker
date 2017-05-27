<?php
namespace core;

use Phalcon\Di;
use utils\IPTools;
use utils\Tools;

/**
 * Created by PhpStorm.
 * User: scaryken
 * Date: 2017/4/25
 * Time: 22:56
 */
class UserService
{

    public static function login()
    {
        $di = Di::getDefault();
        if (empty ($_COOKIE ["c_secure_pass"]) || empty ($_COOKIE ["c_secure_uid"]) || empty ($_COOKIE ["c_secure_login"])) {
          $di->set('current_user', self::getUnLoginUser());
          return;
        }
        $b_id = base64_decode($_COOKIE ["c_secure_uid"]);
        $id = 0 + $b_id;
        if (!$id || !Tools::isValidId($id) || strlen($_COOKIE ["c_secure_pass"]) != 32) {
            $di->set('current_user', self::getUnLoginUser());
            return;
        }
        $user = Users::findFirst(['id=' . $id]);
        if (!$user) {
            $di->set('current_user', self::getUnLoginUser());
            return;
        }
        if ($_COOKIE ["c_secure_login"] == base64_encode("yeah")) {
            if ($_COOKIE ["c_secure_pass"] != md5($user->passhash . $_SERVER ["REMOTE_ADDR"])) {
                return;
            }
        } else {
            if ($_COOKIE ["c_secure_pass"] !== md5($user->passhash)) {
                return;
            }
        }
        if (!$user->passkey) {
            $passkey = md5($user->username . date("Y-m-d H:i:s") . $user->passhash);
            db_query("UPDATE users SET passkey = " . sqlesc($passkey) . " WHERE id=" . sqlesc($user->id));
        }
//         $ip = IPTools::getIp();
//         $user->ip = $ip;
        if ($user) {
            $di->set('current_user', $user);
        } else {
            $di->set('current_user', self::getUnLoginUser());
        }
    }

    public static function getUnLoginUser()
    {
        $user = new Users();
        $user->id = 0;
        return $user;
    }

}