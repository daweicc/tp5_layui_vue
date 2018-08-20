<?php
/**
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/8/15
 * Time: 18:12
 */

namespace app\admin\controller;


class Index
{
    public function index()
    {
        $data['list'] = 34563;
        return view('index', $data);
    }

}