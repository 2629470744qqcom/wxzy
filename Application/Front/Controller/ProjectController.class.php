<?php
namespace Front\Controller;
use Think\Controller;

class ProjectController extends Controller {
    public function index(){
        $slide = M('Project_slides')->field('id,pic,sort,url, title')->order('sort desc')->limit(6)->select();
        $this->assign('slide', $slide);
     
            $full = M('Project')->field('id,pic,type')->order('id desc')->select();
            $this->assign('full', $full);
              
            $house = M('Project')->field('id,pic,type')->where(array('type' => '别墅'))->order('id desc')->select();
            $this->assign('house',$house);
           
     
            $high = M('Project')->field('id,pic,type')->where(array('type' => '高层'))->order('id desc')->select();
            $this->assign('high', $high);
           
 
            $shop = M('Project')->field('id,pic,type')->where(array('type' => '商业'))->order('id desc')->select();
            $this->assign('shop',$shop);
         
        $this->display();
    }

    public function details(){
        $pro=M('Project a')->field('a.id,a.title,a.desc,a.pic,a.tel,a.url_720, a.type')->where('a.id='.I('get.id'))->find();

        $pro['desc'] = htmlspecialchars_decode($pro['desc']);

        $this->assign('pro',$pro);
        $this->display();
    }
}