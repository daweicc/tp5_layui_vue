<?php
/**
 * 打印数据工具类
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/6/5
 * Time: 16:09
 */

namespace app\admin\Utils;


class PrintUtils
{
    /**
     * 格式化数据
     * @param int $status  状态码 一般情况下 1：成功  0：失败
     * @param array $data  数据体
     * @param string $info 提示信息
     * @param string $url  跳转页面
     * @return array
     */
    public static function P($status = 1,$data = array(), $info = '', $url = '')
    {
        $parseData = array();
        if (empty($info)) $info = 'success';

        $parseData['status'] = $status;
        $parseData['info'] = $info;
        $parseData['data'] = $data;
        $parseData['url'] = $url;
        return $parseData;
    }

    /**
     * 正确返回
     * 状态码与$this->success一致
     * @param string $info
     * @param null $data
     * @param string $url
     * @return array
     */
    public static function S($info = '', $data = null, $url = '')
    {
        return self::P(1, $data, $info, $url);
    }


    /**
     * 错误返回
     * 状态码与$this->error一致
     * @param string $info
     * @param $url
     * @return array
     */
    public static function E($info='', $url)
    {
        return self::P(0, null, $info, $url);
    }

    /**
     * Json格式输出 相当于ajaxReturn
     * @param $data
     * @param int $json_option
     */
    public static function R($data, $json_option=0)
    {
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($data,$json_option));
    }


}