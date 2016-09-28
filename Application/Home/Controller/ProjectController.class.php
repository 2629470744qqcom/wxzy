<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\BaseController;

class ProjectController extends BaseController {
	public function index () 
	{
		$lists = M('project')->order('create_time Desc')->select();

        $this->assign('lists', $lists);
        $this->assign('app_name', 'project_index');

		$this->display();
	}

    public function del($id)
    {
        if ($id) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/Public/'.M('project')->where('id='.$id)->getfield('pic'));
            M('project')->delete($id);
        }

        $this->redirect("Project/index");
    }

    public function edit()
    {
        if (IS_POST) {
            if ($_FILES['pic']['name']) {
                $_POST['pic'] = $this->uploadProjectImg('project_'.I('post.id'));
            } else {
                unset($_POST['pic']);
            }

            $about = M('project');

            if($about->create()){
                $about->save(); // 写入数据到数据库
            }

            $this->redirect('Project/index');
        } else {
            if (!I('get.id')) { 
                $this->error("参数不正确");
            }            
        }


        $info = M('project')->where('id='.I('get.id'))->find();

        $this->assign('info', $info);
        $this->assign('action_url', U('Project/edit'));
        $this->assign('app_name', 'project_index');

        $this->display('add');
    }

    public function add ()
    {
        if (IS_POST) {
            $_POST['pic'] = $this->uploadProjectImg('project_'.(M('about_slides')->max('id') + 1));
            $about = M('project');

            if($about->create()){
                $about->add(); // 写入数据到数据库
            }

            $this->redirect('Project/slides');
        }

        $this->assign('info', array());
        $this->assign('action_url', U('Project/add'));
        $this->assign('app_name', 'project_index');

        $this->display();
    }












	public function slides()
    {
        $lists = M('project_slides')->order('sort Desc')->select();

        $this->assign('lists', $lists);
        $this->assign('app_name', 'project_slides');

        $this->display();
    }

    public function slidesDel($id)
    {
        if ($id) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/Public/'.M('project_slides')->where('id='.$id)->getfield('pic'));
            M('about_slides')->delete($id);
        }

        $this->redirect("Project/slides");
    }

    public function slidesEdit()
    {
        if (IS_POST) {
            if ($_FILES['pic']['name']) {
                $_POST['pic'] = $this->uploadProjectImg('project_slides_'.I('post.id'));
            } else {
                unset($_POST['pic']);
            }

            $about = M('project_slides');

            if($about->create()){
                $about->save(); // 写入数据到数据库
            }

            $this->redirect('Project/slides');
        } else {
            if (!I('get.id')) { 
                $this->error("参数不正确");
            }            
        }


        $info = M('project_slides')->where('id='.I('get.id'))->find();

        $this->assign('info', $info);
        $this->assign('action_url', U('Project/slidesEdit'));
        $this->assign('app_name', 'project_slides');

        $this->display('slidesAdd');
    }

    public function slidesAdd ()
    {
        if (IS_POST) {
            $_POST['pic'] = $this->uploadProjectImg('project_slides_'.(M('project_slides')->max('id') + 1));
            $about = M('project_slides');

            if($about->create()){
                $about->add(); // 写入数据到数据库
            }

            $this->redirect('Project/slides');
        }

        $this->assign('info', array());
        $this->assign('action_url', U('Project/slidesAdd'));
        $this->assign('app_name', 'project_slides');

        $this->display();
    }
}