<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\BaseController;

class ActivityController extends BaseController {
	public function index () 
	{
		$lists = M('activity')->order('create_time Desc')->select();

        $this->assign('lists', $lists);
        $this->assign('app_name', 'activity_index');

		$this->display();
	}

    public function del($id)
    {
        if ($id) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/Public/'.M('activity')->where('id='.$id)->getfield('pic'));
            M('activity')->delete($id);
        }

        $this->redirect("Activity/index");
    }

    public function edit()
    {
        if (IS_POST) {
            if ($_FILES['pic']['name']) {
                $_POST['pic'] = $this->uploadImg('activity_'.I('post.id'));
            } else {
                unset($_POST['pic']);
            }

            $about = M('activity');

            if($about->create()){
                $about->save(); // 写入数据到数据库
            }

            $this->redirect('Activity/index');
        } else {
            if (!I('get.id')) { 
                $this->error("参数不正确");
            }            
        }


        $info = M('activity')->where('id='.I('get.id'))->find();

        $this->assign('info', $info);
        $this->assign('action_url', U('activity/edit'));
        $this->assign('app_name', 'activity_index');

        $this->display('add');
    }

    public function add ()
    {
        if (IS_POST) {
            $_POST['pic'] = $this->uploadImg('activity_'.(M('about_slides')->max('id') + 1));
            $about = M('activity');

            if($about->create()){
                $about->add(); // 写入数据到数据库
            }

            $this->redirect('Activity/index');
        }

        $this->assign('info', array());
        $this->assign('action_url', U('Activity/add'));
        $this->assign('app_name', 'activity_index');

        $this->display();
    }











	public function slides()
    {
        $lists = M('activity_slides')->order('sort Desc')->select();

        $this->assign('lists', $lists);
        $this->assign('app_name', 'activity_slides');

        $this->display();
    }

    public function slidesDel($id)
    {
        if ($id) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/Public/'.M('activity_slides')->where('id='.$id)->getfield('pic'));
            M('about_slides')->delete($id);
        }

        $this->redirect("Activity/slides");
    }

    public function slidesEdit()
    {
        if (IS_POST) {
            if ($_FILES['pic']['name']) {
                $_POST['pic'] = $this->uploadImg('activity_slides_'.I('post.id'));
            } else {
                unset($_POST['pic']);
            }

            $about = M('activity_slides');

            if($about->create()){
                $about->save(); // 写入数据到数据库
            }

            $this->redirect('Activity/slides');
        } else {
            if (!I('get.id')) { 
                $this->error("参数不正确");
            }            
        }


        $info = M('activity_slides')->where('id='.I('get.id'))->find();

        $this->assign('info', $info);
        $this->assign('action_url', U('Activity/slidesEdit'));
        $this->assign('app_name', 'activity_slides');

        $this->display('slidesAdd');
    }

    public function slidesAdd ()
    {
        if (IS_POST) {
            $_POST['pic'] = $this->uploadImg('activity_slides_'.(M('activity_slides')->max('id') + 1));
            $about = M('activity_slides');

            if($about->create()){
                $about->add(); // 写入数据到数据库
            }

            $this->redirect('Activity/slides');
        }

        $this->assign('info', array());
        $this->assign('action_url', U('Activity/slidesAdd'));
        $this->assign('app_name', 'activity_slides');

        $this->display();
    }
}