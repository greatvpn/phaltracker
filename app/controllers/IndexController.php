<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->current_page = '首页';
        $news = \core\News::find([
            'order' => 'id DESC',
            'limit' => '5'
        ]);
        $news_for_view = [];
        if ($news) {
            foreach ($news as $i=>$new) {
                $new_for_view = new stdClass();
                if($i==0){
                    $new_for_view->active='active';
                }
                else{
                    $new_for_view->active='';
                }
                $new_for_view->title = $new->title;
                $new_for_view->body = $new->body;
                $new_for_view->added = $new->added;
                $new_for_view->id = $new->id;
                $news_for_view[] = $new_for_view;
            }
        }
        $this->view->news = json_encode($news_for_view);
        $shoutbox_for_view = [];
        $shoutbox = \core\Shoutbox::find([
            'order' => 'id DESC',
            'limit' => '50'
        ]);
        if ($shoutbox) {
            foreach ($shoutbox as $i=>$item) {
                $shout_data = new stdClass();
                $shout_data->user = \core\Users::findFirst("id=" . $item->userid);
                $shout_data->time = date('Y-m-d H:i:s',$item->date);
                $shout_data->message = $item->text;
                $shoutbox_for_view[] = $shout_data;
            }
        }
        $this->view->shoutbox = json_encode($shoutbox_for_view);
    }
}

