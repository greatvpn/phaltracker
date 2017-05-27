<?php
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $user=$this->di->get('current_user');
        $user_for_view=new stdClass();
        $user_for_view->id=$user->id;
        $user_for_view->name=$user->username;
        $user_for_view->uploaded=$user->uploaded;
        $user_for_view->downloaded=$user->downloaded;
        $user_for_view->seedbonus=$user->seedbonus;
        $user_for_view->leechwarn=$user->leechwarn;
        $user_for_view->seedbonus=$user->seedbonus;
        $user_for_view->avatar='http://img.hb.aicdn.com/afc8d613b8d9dcaa5821fb6a6a8d16a39d74934221258-lPoHXB_fw658';
        $this->view->current_user=json_encode($user_for_view);
        $this->view->sitename='北洋园PT';
    }
}
