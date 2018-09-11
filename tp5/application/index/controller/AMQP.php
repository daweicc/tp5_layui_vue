<?php
/**
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/9/11
 * Time: 10:37
 */

namespace app\index\controller;


class AMQP extends \AMQPConnection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getHost() {

    }

}