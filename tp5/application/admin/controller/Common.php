<?php
/**
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/8/21
 * Time: 11:31
 */

namespace app\admin\controller;


class Common
{

    public function ajaxReturn($data, $json_option = 0)
    {
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($data,$json_option));
    }

}