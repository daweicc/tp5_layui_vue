<?php
/**
 * Created by PhpStorm.
 * User: daweicc
 * Date: 2018/3/7
 * Time: 11:50
 */

namespace Common\Utils;


class FormatArrayUtils
{
    /**
     * 数组键名转换为指定字段值
     * @param array $data
     * @param string $key
     * @param string $val
     * @return array
     */
    public static function changeKey($data=array(), $key='', $val = '')
    {
        if(empty($data) || empty($key)) return $data;

        $returnRes = array();

        if (empty($val)) {                              //返回的是键名随影数组 1 =>array(id=>1,name='dawei'), 2=>array(id=>2,name='xixi')
            foreach ($data as $k => $v) {
                if($v[$key])
                    $returnRes[$v[$key]] = $v;
            }
        } else {
            foreach ($data as $k => $v) {               //返回的是键名对应键值 1 =>'dawei', 2=>'xixi'
                if($v[$key])
                    $returnRes[$v[$key]] = $v[$val];
            }
        }


        return $returnRes;
    }


    /**
     * 根据字段值分组
     * @param $data
     * @param $key
     * @return array
     */
    public static function changeKeyArray($data, $key)
    {
        if(empty($data) || empty($key)) return $data;

        $resData = array();
        foreach ($data as $k=>$v) {
            $resData[$v[$key]][] = $data[$k];
        }

        return $resData;
    }


    /**
     * @param $data     被匹配数据源
     * @param $key      被匹配数据对应的字段名
     * @param $val      匹配值
     * @param $fields   返回的数据对应的字段名
     * @param string $default  默认值
     * @return mixed  字段$fields对应的值
     */
    public static function returnValueByKv($data, $key, $val, $fields, $default = '')
    {
        $reVal = $default;
        foreach ($data as $k => $v) {
            if ($v[$key] == $val) {
                $reVal = $fields ? $v[$fields] : $data[$k];
                break;
            }
        }

        return $reVal;

    }

    /**
     * 给定字段名，合并相同字段名的值
     * @param $initVal     初始值
     * @param array $data  数据源
     * @param $key         想要获取数据的键名
     * @return array
     */
    public static function unionValueByKey($data=array(),$key,$initVal){
        unset($v);
        $lists = array();

        if (!empty($initVal)) $lists[] = $initVal;
        unset($v);
        foreach($data as $k=>$v){

            $lists[] = $v[$key];
        }

        $lists = array_unique($lists);
        return $lists;
    }

    /**
     * 将数组2中满足数组1条件的数据合并到数组1
     * @param $arrOne
     * @param $arrTwo
     * @param string $field
     * @param int $defaultVal
     * @return mixed
     */
    public static function unionArrayMerge($arrOne, $arrTwo, $field = 'id', $defaultVal = 0)
    {
        if (empty($arrOne) || empty($arrTwo)) return $arrOne;

        $default = array();
        foreach ($arrTwo as $two) {                             //获取默认下标
            if (empty($default)) {
                if(!empty($two)) $default = $two;
            } else {
                break;
            }
        }

        foreach ($arrOne as $k => $v) {
            if (!empty($arrTwo[$v[$field]])) {
                $arrOne[$k] = array_merge($arrTwo[$v[$field]], $arrOne[$k]);
            } else {
                unset($val);
                foreach ($default as $key=>$val) {              //没有符合条件的数据时，字段值用空格填充
                    $arrTwo[$v[$field]][$key] = $defaultVal;
                }
                $arrOne[$k] = array_merge($arrTwo[$v[$field]], $arrOne[$k]);
            }
        }

        return $arrOne;

    }

    /**
     *
     * @param array $data 二维数组
     * @param array $arr  一维数组
     * @return array 相同字段数据
     */
    public static function arrayEquals($data = array(), $arr)
    {
        if(empty($data) || empty($arr)) return $data;

        $equals = array();
        foreach ($data as $k => $v) {

            if (in_array($k, $arr)) {
                $equals[$k] = $v;
            }
        }

        return $equals;
    }



}