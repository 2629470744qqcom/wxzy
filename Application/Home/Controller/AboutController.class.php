<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\BaseController;

class AboutController extends BaseController {
    public function index(){
    	if (IS_POST) {

            M('about')->where('1')->delete();
    		$about = M('about');
    		if($about->create()){
			    $about->add(); // 写入数据到数据库
			}

            $this->redirect("About/index");
    	}

    	$info = M('about')->find();
    	$this->assign('info', $info);
        $this->assign('app_name', 'about_index');

        $this->display();
    }

    public function slides()
    {
        $m=M('about_slides');
        $p = getpage($m,$where,12);
        $show = $p->show();
        $this->assign('page',$show);
        $lists = $m->field(true)->order('sort Desc')->select();
        $this->assign('lists', $lists);
        $this->assign('app_name', 'about_slides');

        $this->display();
    }

    public function del($id)
    {
        if ($id) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/Public/'.M('about_slides')->where('id='.$id)->getfield('pic'));
            M('about_slides')->delete($id);
        }

        $this->redirect("About/slides");
    }

    public function edit()
    {
        if (IS_POST) {
            if ($_FILES['pic']['name']) {
                $_POST['pic'] = $this->uploadImg('about_slides_'.I('post.id'));
            } else {
                unset($_POST['pic']);
            }

            $about = M('about_slides');

            if($about->create()){
                $about->save(); // 写入数据到数据库
            }

            $this->redirect('About/slides');
        } else {
            if (!I('get.id')) { 
                $this->error("参数不正确");
            }            
        }


        $info = M('about_slides')->where('id='.I('get.id'))->find();

        $this->assign('info', $info);
        $this->assign('action_url', U('About/edit'));
        $this->assign('app_name', 'about_slides');

        $this->display('add');
    }

    public function add ()
    {
        if (IS_POST) {
            $_POST['pic'] = $this->uploadImg('about_slides_'.(M('about_slides')->max('id') + 1));
            $about = M('about_slides');
          
            if($about->create()){
                $about->add(); // 写入数据到数据库
            }

            $this->redirect('About/slides');
        }

        $this->assign('info', array());
        $this->assign('action_url', U('About/add'));
        $this->assign('app_name', 'about_slides');

        $this->display();
    }
}