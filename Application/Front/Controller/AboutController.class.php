<?php
namespace Front\Controller;
use Think\Controller;
class AboutController extends Controller {
    public function index(){
    	
    	
    	layout(false);

        $this->display();
    }
}