<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller {
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
}