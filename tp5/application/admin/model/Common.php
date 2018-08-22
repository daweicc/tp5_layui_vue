<?php
/**
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/8/21
 * Time: 15:15
 */

namespace app\admin\model;


use think\Db;
use think\Model;

class Common extends Model
{
    protected $_auto_rechange = array();
    /**
     * 获取数据-兼容layUI数据格式
     * @param array $where
     * @param int $page
     * @param int $pageSize
     * @param string $fields
     * @param string $orderBy
     * @param string $groupBy
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getDataByPage($where = array(), $page = 1, $pageSize = 10, $fields='*', $orderBy = '', $groupBy = '')
    {
        if (!$page) $page = 1;
        if ($groupBy) $this->group($groupBy);

        $total = $this->where($where)->count();

        $pages = ceil($total/$pageSize);

        $this->field($fields);

        $page = $page > $pages ? $pages : $page;

        $this->limit($pageSize)->page($page);

        $this->where($where);

        if ($orderBy == '') {
            $pk = $this->getPk();
            $order = $pk . ' DESC';
            if (is_array($pk)) {
                $order = '';
                foreach ($pk as $k) {
                    $order = $order == '' ? ($order . $k . ' DESC') : ($order . ','. $k . ' DESC');
                }
            }
            $this->order($order);
        }else {
            $this->order($orderBy);
        }

        $data = Db::table($this->getTable())->select();

        $data = $this->formatData($data);                                   //格式化数据

        return array('code'=>200, 'msg'=>empty($data) ? '暂无数据' : '查询成功', 'count'=>$total,'data'=>empty($data) ? array() : $data);
    }



    /**
     * 格式化时间
     * @param $data
     * @param string $formatType
     * @return mixed
     */
    private function formatData($data, $formatType = 'Y-m-d H:i:s')
    {
        if (empty($data)) return $data;
        $auto_rechange = $this->_auto_rechange;

        foreach ($data as $k=>&$v) {
            foreach ($v as $k=>$item) {
                if (strpos($k, 'time')) {                                    //格式化时间
                    if ($v[$k] != 0) {
                        $v[$k] = date($formatType, $v[$k]);
                    } else {
                        $v[$k] = '';
                    }
                }

                if (!empty($auto_rechange) && isset($auto_rechange[$k])) {   //自定义字段状态码转换为状态码对应的描述
                    $thisAuto = $auto_rechange[$k];
                    isset($thisAuto['text'][$v[$k]]) && $v[$thisAuto['alias']] = $thisAuto['text'][$v[$k]];
                }
            }
        }

        return $data;
    }

    /**
     * 根据条件获取数据/无分页
     * @param $where
     * @param string $fields
     * @param string $orderBy
     * @param string $groupBy
     * @return false|mixed|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getDataWithoutPage($where, $fields='*', $orderBy = '', $groupBy = '')
    {
        if ($groupBy) $this->group($groupBy);

        $this->field($fields);

        $this->where($where);

        if ($orderBy == '') {
            $pk = $this->getPk();
            $order = $pk . ' DESC';
            if (is_array($pk)) {
                $order = '';
                foreach ($pk as $k) {
                    $order = $order == '' ? ($order . $k . ' DESC') : ($order . ','. $k . ' DESC');
                }
            }
            $this->order($order);
        }else {
            $this->order($orderBy);
        }

        $data = $this->select();

        $data = $this->formatData($data);

        return $data;

    }


//    /**
//     * 保存数据
//     * @param array $where
//     * @param $data
//     * @return array
//     */
//    public function saveData($where = array(), $data)
//    {
//        if (empty($where)) return PrintUtils::E('操作失败');;
//        $this->where($where);
//        if ($this->save($data) !== false) {
//            return PrintUtils::S('保存成功');
//        } else {
//            return PrintUtils::E('操作失败');
//        }
//    }
//
//
//    /**
//     * 获取总数
//     * @param $model
//     * @param array $where
//     * @return mixed
//     */
//    public function getCount($model, $where = array()){
//        return Db:name($model)->where($where)->count();
//    }

}