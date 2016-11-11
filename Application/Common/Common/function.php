<?php


/**
 * TODO 基础分页的相同代码封装，使前台的代码更少
 * @param $m 模型，引用传递
 * @param $where 查询条件
 * @param int $pagesize 每页查询条数
 * @return \Think\Page
 */
function getpage(&$m,$where,$pagesize=10){
    $count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
    $p=new \Think\Page($count,$pagesize);
    $p->lastSuffix=false;
    $p->rollPage = 10;
    $p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    $p->setConfig('prev','上一页');
    $p->setConfig('next','下一页');
    $p->setConfig('last','末页');
    $p->setConfig('first','首页');
    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
    $p->parameter=I('get.');
    $m->limit($p->firstRow.','.$p->listRows);
    return $p;
}