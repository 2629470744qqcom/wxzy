<?php
namespace Front\Controller;
use Think\Controller;

class ProjectController extends Controller {
    public function index(){
        $slide = M('Project_slides')->field('id,pic,sort,url')->order('sort desc')->limit(6)->select();
        $this->assign('slide', $slide);

        if (!I("get.category")) {
            $full = M('Project')->field('id,pic,type')->order('id desc')->select();
            $this->assign('full', $full);
        }

        if ('bs' == I("get.category")) {
            $house = M('Project')->field('id,pic,type')->where(array('type' => '别墅'))->order('id desc')->select();
            $this->assign('full',$house);
            $this->assign('current_category', 'bs');
        }

        if ('gc' == I('get.category'))
        {
            $high = M('Project')->field('id,pic,type')->where(array('type' => '高层'))->order('id desc')->select();
            $this->assign('full', $high);
            $this->assign('current_category', 'gc');

        }

        if ('sy' == I("get.category")) {
            $shop = M('Project')->field('id,pic,type')->where(array('type' => '商业'))->order('id desc')->select();
            $this->assign('full',$shop);
            $this->assign('current_category', 'sy');
        }
        $this->display();
    }

    public function details(){
        $pro=M('Project a')->field('a.id,a.title,a.desc,a.pic,a.tel,a.url_720, a.type')->where('a.id='.I('get.id'))->find();

        $pro['desc'] = htmlspecialchars_decode($pro['desc']);

        $this->assign('pro',$pro);
        $this->display();
    }
}