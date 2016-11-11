<?php
namespace Front\Controller;
use Think\Controller;

class MagazineController extends Controller {
    public function index(){
        $info = M("magazine")->order('create_time DESC')->where('is_essence !=1')->select();

        array_walk($info, function($v, $k){
            if ('desc' == $k) {
                $v = htmlspecialchars_decode($v);
            }
        });

        $this->assign('info', $info);

        $infos = M()->table('wxzy_magazine m,wxzy_magazine_slides s')->field('m.id,m.sort,m.title,s.pic,m.is_essence')->where('m.is_essence = 1')->order('m.sort desc')->limit(6)->select();
        
        array_walk($info, function($v, $k){
            if ('desc' == $k) {
                $v = htmlspecialchars_decode($v);
            }
        });

        $this->assign('infos',$infos);

        $infoEssence = M()->table('wxzy_magazine m,wxzy_magazine_slides s')->field('m.id,m.title,s.pic,m.is_essence')->where('m.is_essence = 1')->find();
        $this->assign('infoEssence', $infoEssence);

        $face=M('Magazine_face')->find();
        $this->assign("face",$face);

        $this->display();
    }

    public function profile()
    {
        $id = I('get.id');
        $info = M('magazine')->find($id);
        $info['desc'] = htmlspecialchars_decode($info['desc']);

        $this->assign('info', $info);
        $this->display();
    }
}