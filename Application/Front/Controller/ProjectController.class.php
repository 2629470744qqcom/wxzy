<?php
namespace Front\Controller;
use Think\Controller;

class ProjectController extends Controller {
    public function index(){
    	$info = M("project")->select();
        $this->assign("info", $info);

        $infoSlides = M('project_slides')->select();
        $this->assign('infoSlides', $infoSlides);

        $this->display();
    }

    public function profile()
    {
    	$id = I('get.id');

    	$info = M('project')->find($id);
    	$this->assign('info', $info);

    	$this->display();
    }
}