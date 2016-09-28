<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\BaseController;

class IndexController extends BaseController {
    public function index(){
    	$this->assign('app_name', 'home');

        $this->display();
    }
}