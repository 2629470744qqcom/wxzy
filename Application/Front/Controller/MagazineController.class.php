<?php
namespace Front\Controller;
use Think\Controller;

class MagazineController extends Controller {
    public function index(){
    	$info = M("magazine")->order('create_time DESC')->select();
    	$this->assign('info', $info);

    	$infoEssence = M('magazine_slides')->find();
    	$this->assign('infoEssence', $infoEssence);

        $this->display();
    }

    public function profile()
    {
    	$id = I('get.id');

    	$info = M('magazine')->find($id);
    	$this->assign('info', $info);

    	$this->display();
    }
}