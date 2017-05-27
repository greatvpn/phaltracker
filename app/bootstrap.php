<?php
/**
 * Created by PhpStorm.
 * User: scaryken
 * Date: 2017/4/25
 * Time: 22:43
 */
function initAutoload(){
    require_once APP_PATH.'/AutoLoader.php';
    $autoloader=new AutoLoader(APP_PATH.'/');
    $autoloader->registerAutoLoadPath();
}
function checkAccessibleIp(){
    return true;
//@see functions.php userlogin()
}
initAutoload();
$isAllowedIp=checkAccessibleIp();
if($isAllowedIp){
    \core\UserService::login();
}
else{
    //禁止的ip处理
}

