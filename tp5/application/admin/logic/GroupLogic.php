<?php
/**
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/8/21
 * Time: 11:30
 */

namespace app\admin\logic;
use app\admin\Utils\PrintUtils;
use app\admin\Utils\TreeUtils;
use think\Db;

class GroupLogic
{

    /**
     * 获取部门列表信息
     * @return array|false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getGroupList()
    {
        $groupList = Db::name('Group')->select();
        $groupList = TreeUtils::tree($groupList);
        return PrintUtils::S($groupList);
    }

}