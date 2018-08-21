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
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->ajaxReturn(GroupLogic::getGroupList());

    }

}