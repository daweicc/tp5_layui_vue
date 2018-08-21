<?php
/**
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/7/27
 * Time: 10:07
 */

namespace app\admin\Utils;


class TreeUtils
{
    private static $idField = 'id';
    private static $pField = 'pid';

    /**
     * 格式化数据为无限极层级
     * @param $rows
     * @param int $root_id
     * @return array
     */
    public static function tree($rows, $root_id = 0) {
//        ini_set("memory_limit","100M");
        $tree = array();
        foreach($rows as $k => $v) {                 //父亲找到儿子
            if($v[self::$pField] == $root_id) {
                $v['children'] = self::tree($rows, $v[self::$idField]);
                $tree[] = $v;
//                unset($rows[$k]);
            }
        }
        return $tree;
    }

}