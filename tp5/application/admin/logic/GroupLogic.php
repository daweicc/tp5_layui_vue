<?php
/**
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/8/21
 * Time: 11:30
 */

namespace app\admin\logic;
use app\admin\Utils\TreeUtils;

class GroupLogic
{

    /**
     * 获取部门列表信息
     * @return mixed
     */
    public static function getGroupList()
    {
        $groupList = model('Group')->getDataByPage(array('pid'=>0));

        $list = $groupList['data'];
//        foreach ($list as &$item) {
//            $item['text'] = '<li class="layui-nav-item layui-nav-itemed"><span class="layui-nav-more"></span><span style="margin-left:5px;">' . $item['text'] . '</span></li>';
//        }

        $list = TreeUtils::tree($list);
        $groupList['data'] = $list;
//        p($groupList);die;
        return $groupList;
    }

}