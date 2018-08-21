<?php
/**
 * 通用数据格式验证工具
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/6/8
 * Time: 15:01
 */

namespace Common\Utils;


class DataVerifyUtils
{
    /**
     * 手机号格式验证
     * @param $mobile
     * @return false|int
     */
    public static function isMobile($mobile)
    {
        return preg_match("/^1[3-5,7-8]{1}[0-9]{9}$/", $mobile);
    }

    /**
     * 邮箱格式验证
     * @param $string
     * @return false|int
     */
    public static function isEmail($string)
    {
        return preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $string);
    }

}