<?php

namespace Front\Controller;
use Think\Controller;

class AboutController extends Controller {
    public function index(){
    	$info = M("about")->find();
		$info['desc'] = htmlspecialchars_decode($info['desc']);
    	$this->assign("info", $info);

    	$infoSlides = M('about_slides')->order('sort desc')->limit(6)->select();
    	$this->assign('infoSlides', $infoSlides);


        $this->display();
    }
}