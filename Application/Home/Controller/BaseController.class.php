<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller {
    protected function _initialize()
    {
        if (!session("?current_user_id")) {
            if ('login' != ACTION_NAME) {
                $this->redirect("Base/login");
            }

        } else {
            $this->assign('username', M('admins')->where('id='.session("current_user_id"))->getField('name'));
        }
    }

    protected function uploadImg($file_name)
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public/'; // 设置附件上传根目录
        $upload->savePath = 'imgs/';
        $upload->autoSub  = false;
        $upload->replace  = true;
        $upload->saveName = $file_name;
        // 上传单个文件 
        $info = $upload->uploadOne($_FILES['pic']);

        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }

        return $info['savepath'].$info['savename'];
    }

    protected function uploadMagazineImg($file_name)
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public/'; // 设置附件上传根目录
        $upload->savePath = 'magazines/';
        $upload->autoSub  = false;
        $upload->replace  = true;
        $upload->saveName = $file_name;
        // 上传单个文件 
        $info = $upload->uploadOne($_FILES['pic']);

        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }

        return $info['savepath'].$info['savename'];
    }

    protected function uploadActivityImg($file_name)
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public/'; // 设置附件上传根目录
        $upload->savePath = 'activity/';
        $upload->autoSub  = false;
        $upload->replace  = true;
        $upload->saveName = $file_name;
        // 上传单个文件 
        $info = $upload->uploadOne($_FILES['pic']);

        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }

        return $info['savepath'].$info['savename'];
    }

    protected function uploadProjectImg($file_name)
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public/'; // 设置附件上传根目录
        $upload->savePath = 'project/';
        $upload->autoSub  = false;
        $upload->replace  = true;
        $upload->saveName = $file_name;
        // 上传单个文件 
        $info = $upload->uploadOne($_FILES['pic']);

        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }

        return $info['savepath'].$info['savename'];
    }







    public function login()
    {
        if (IS_POST) {
            $name = I('post.name');
            $pwd = I('post.passwd');

            if ($name == M('admins')->where('name="'.$name.'"')->getField('name') and 
                md5($name . '_WxzY_' . $pwd) == M('admins')->where('name="'.$name.'"')->getField("password")) {

                session("current_user_id", M('admins')->where('name="'.$name.'"')->getField('id'));
                session("current_user_name", $name);

                $this->redirect("Index/index");
            }

            $this->error("用户名或密码不正确");
        }

        layout('Base_layout'); // 临时关闭当前模板的布局功能
        $this->display();
    }

    public function changePW()
    {
        if (IS_POST) {
            if (I("post.passwd")) {
                M('admins')->where('id='.session("current_user_id"))->setField("password", md5(session("current_user_name"). '_WxzY_' . I("post.passwd")));

                $this->success("密码更改成功");
                $this->redirect("Index/index");
            }
        }

        $this->display();
    }

    public function changeName()
    {
        if (IS_POST) {
            if (I("post.name")) {
                session("current_user_name", I("post.name"));
                M('admins')->where('id='.session("current_user_id"))->setField("name", I("post.name"));
                M('admins')->where('id='.session("current_user_id"))->setField("password", md5(session("current_user_name"). '_WxzY_' . I("post.passwd")));


                $this->success("用户名更改成功");
                $this->redirect("Index/index");
            }
        }

        $this->display();
    }

    public function logout()
    {
        session(null);

        $this->redirect('Base/login');
    }
}