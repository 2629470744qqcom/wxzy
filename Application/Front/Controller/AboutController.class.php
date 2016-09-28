<?php
namespace Front\Controller;
use Think\Controller;
class AboutController extends Controller {
    public function index(){
    	$info = M("about")->find();
    	$this->assign("info", $info);

    	$infoSlides = M('about_slides')->select();
    	$this->assign('infoSlides', $infoSlides);


        $this->display();
    }
}