<?php
/**
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/8/20
 * Time: 16:56
 */

namespace app\admin\controller;


use app\admin\logic\GroupLogic;

class Group extends Common
{
    /**
     * 获取部门列表信息
     * @return string
     */
    public function index()
    {

//        $t = GroupLogic::getGroupList();
//        $groupList = model('group')->select();
//        p(546746);die;
        $this->ajaxReturn(GroupLogic::getGroupList());

    }

}