<?php
namespace Front\Controller;
use Think\Controller;

class ActivityController extends Controller {
    public function index(){
    	$info = M("activity")->select();
        $this->assign("info", $info);

        $infos = M("activity")->where('status =1')->select();
        $this->assign("infos", $infos);

        $infop = M("activity")->where('status != 1')->select();
        $this->assign("infop", $infop);

        $infoSlides = M('activity_slides')->order('sort desc')->select();
        $this->assign('infoSlides', $infoSlides);

        $this->display();
    }

    public function profile()
    {
    	$id = I('get.id');

    	$info = M('activity')->find($id);
        $info['desc'] = htmlspecialchars_decode($info['desc']);
    	$this->assign('info', $info);

    	$this->display();
    }
}