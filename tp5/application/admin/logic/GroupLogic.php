<?php
/**
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/8/21
 * Time: 11:30
 */

namespace app\admin\logic;


class GroupLogic
{

    public static function getGroupList()
    {

//        $groupList = model('Group')->select();
//        p($groupList);die;

//        $groupList = model('Group')->select();
//        p($groupList);die;

        $groupList = model('Group')->getByText('用户服务部');

        return $groupList;
        
    }

}