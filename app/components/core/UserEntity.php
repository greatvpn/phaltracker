<?php
/**
 * Created by PhpStorm.
 * User: scaryken
 * Date: 2017/4/26
 * Time: 0:44
 */

namespace core;


class UserEntity
{
    const UC_PEASANT = 0;
    const UC_USER = 1;
    const UC_POWER_USER = 2;
    const UC_ELITE_USER = 3;
    const UC_CRAZY_USER = 4;
    const UC_INSANE_USER = 5;
    const UC_VETERAN_USER = 6;
    const UC_EXTREME_USER = 7;
    const UC_ULTIMATE_USER = 8;
    const UC_NEXUS_MASTER = 9;
    const UC_VIP = 10;
    const UC_RETIREE = 11;
    const UC_UPLOADER = 12;
    const UC_MODERATOR = 13;
    const UC_ADMINISTRATOR = 14;
    const UC_SYSOP = 15;
    const UC_STAFFLEADER = 16;
    /**
     * @var Users
     */
    private $model;

    /**
     * @param $id
     * @return User|null
     */
    public static function loadById($id){
        $model=Users::findFirst(['id'=>$id]);
        if($model){
            $user=new self();
            $user->model=$model;
            return $user;
        }
        else{
            return null;
        }


    }
    public function login(){

    }

}