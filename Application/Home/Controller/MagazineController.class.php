<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\BaseController;

class MagazineController extends BaseController {
	public function index () 
	{
		$lists = M('magazine')->order('create_time Desc')->select();

        $this->assign('lists', $lists);
        $this->assign('app_name', 'magazine_index');

		$this->display();
	}

	public function edit ()
	{
		if (IS_POST) {
            if ($_FILES['pic']['name']) {
                $_POST['pic'] = $this->uploadMagazineImg(I('post.id'));
            } else {
                unset($_POST['pic']);
            }

            $_POST['create_time'] = time();

            $about = M('magazine');

            if($about->create()){
                $about->save(); // 写入数据到数据库
            }

            $this->redirect('Magazine/Index');
        } else {
            if (!I('get.id')) { 
                $this->error("参数不正确");
            }            
        }

        $info = M("magazine")->where('id='.I("get.id"))->find();

        $this->assign('info', $info);
        $this->assign('action_url', U('Magazine/edit'));
        $this->assign('app_name', 'magazine_index');

		$this->display('add');
	}

	public function add ()
	{
		if (IS_POST) {
        	$_POST['pic'] = $this->uploadMagazineImg(strval(M('magazine')->max('id') + 1));
            $_POST['create_time'] = time();
            $about = M('magazine');

            if($about->create()){
                $about->add(); // 写入数据到数据库
            }

            $this->redirect('Magazine/index');
        }

        $this->assign('info', array());
        $this->assign('action_url', U('Magazine/add'));
        $this->assign('app_name', 'magazine_index');

		$this->display();
	}

	public function del($id)
	{
		if (!$id) {
			$this->error("参数错误");
		}

		M("magazine")->delete($id);

		$this->redirect("Magazine/index");
	}






	public function essence ()
	{
		$lists = M("magazine_slides")->select();

		$this->assign('lists', $lists);
        $this->assign('app_name', 'magazine_essence');

        $magazines = M('magazine')->select();
        $this->assign('magazines', $magazines);

        $current_essence = M('magazine')->where("is_essence = 1")->getfield('id');
        $this->assign('current_essence', $current_essence);

		$this->display();
	}

	public function essenceConfirm () 
	{
		$id = I("post.essence_magazine");

		if (!$id) {
			$this->error("参数错误");
		}

		M("magazine")->where('is_essence = 1')->setField('is_essence', 0);
		M("magazine")->where('id='.$id)->setField('is_essence', 1);

		$this->redirect("Magazine/essence");
	}


	public function essenceSlidesDel($id)
    {
        if ($id) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/Public/'.M('magazine_slides')->where('id='.$id)->getfield('pic'));
            M('magazine_slides')->delete($id);
        }

        $this->redirect("Magazine/essence");
    }

    public function essenceSlidesEdit()
    {
        if (IS_POST) {
            if ($_FILES['pic']['name']) {
                $_POST['pic'] = $this->uploadImg('magazine_essence_slides'.I('post.id'));
            } else {
                unset($_POST['pic']);
            }

            $about = M('magazine_slides');

            if($about->create()){
                $about->save(); // 写入数据到数据库
            }

            $this->redirect('Magazine/essence');
        } else {
            if (!I('get.id')) { 
                $this->error("参数不正确");
            }            
        }


        $info = M('magazine_slides')->where('id='.I('get.id'))->find();

        $this->assign('info', $info);
        $this->assign('action_url', U('magazine/essenceSlidesEdit'));
        $this->assign('app_name', 'magazine_essence');

        $this->display('essenceSlidesAdd');
    }

    public function essenceSlidesAdd ()
    {
        if (IS_POST) {
            $_POST['pic'] = $this->uploadImg('magazine_essence_slides'.(M('magazine_slides')->max('id') + 1));
            $about = M('magazine_slides');

            if($about->create()){
                $about->add(); // 写入数据到数据库
            }

            $this->redirect('Magazine/essence');
        }

        $this->assign('info', array());
        $this->assign('action_url', U('Magazine/essenceSlidesAdd'));
        $this->assign('app_name', 'magazine_essence');

        $this->display();
    }
}