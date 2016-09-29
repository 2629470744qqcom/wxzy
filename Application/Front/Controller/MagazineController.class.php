<?php
namespace Front\Controller;
use Think\Controller;

class MagazineController extends Controller {
    public function index(){
        $info = M("magazine")->order('create_time DESC')->where('is_essence !=1')->select();
        $this->assign('info', $info);

        $infos = M()->table('wxzy_magazine m,wxzy_magazine_slides s')->field('m.id,m.create_time,m.title,s.pic,m.is_essence')->where('m.is_essence = 1')->order('m.create_time desc')->limit(6)->select();
        $this->assign('infos',$infos);

        $infoEssence = M()->table('wxzy_magazine m,wxzy_magazine_slides s')->field('m.id,m.title,s.pic,m.is_essence')->where('m.is_essence = 1')->find();
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