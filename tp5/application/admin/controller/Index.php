<?php
/**
 * Created by PhpStorm.
 * User:daweicc
 * Date: 2018/8/15
 * Time: 18:12
 */

namespace app\admin\controller;
use think\Request;


class Index extends Common
{
    public function index()
    {
        return 'hello word !';
    }

    public function index2()
    {
        return 'hello word !';
    }



    /**
     * 服务端，接收数据，消费者
     */
    public function server()
    {
        set_time_limit(0);

        $options = array(
            'host' => '127.0.0.1',
            'port' => '5672',
            'virtual' => '/',
            'login' => 'guest',
            'password' => 'guest',
        );

        $connection = new \AMQPConnection($options);
        if (!$connection->connect()) {
            die("Cannot connect to the broker!\n");
        }

        // 通道
        $channelObj = new \AMQPChannel($connection);

        // 交换
        $exchangeObj = new \AMQPExchange($channelObj);
        $exchangeObj->setName('first');
        $exchangeObj->setType(AMQP_EX_TYPE_DIRECT); //direct类型
        $exchangeObj->setFlags(AMQP_DURABLE); //持久化

        //创建队列
        $queue = new \AMQPQueue($channelObj);
        $queue->setName('firstQueue');
        $queue->setFlags(AMQP_DURABLE); //持久化
        $bindResult = $queue->bind('first', 'queue_route');

        echo 'Queue Bind: ' . $bindResult . "\n";
        echo "Message:\n";
        while (true) {
            $queue->consume(function (\AMQPenvelope $envelope, \AMQPQueue $queue) {

                $msg = $envelope->getBody();
                echo $msg . "\n"; //处理消息
                //手动发送ACK应答【就是通知RabbitMq，已经处理了这条消息】
                $queue->ack($envelope->getDeliveryTag());
            });
        }
    }


    /**
     * 客户端，生产数据，生产者
     * @param Request $request
     */
    public function client(Request $request)
    {
        $messageBody = $request->get('msg', 'Welcome to RabbitMQ');

        $options = array(
            'host' => '127.0.0.1',
            'port' => '5672',
            'virtual' => '/',
            'login' => 'guest',
            'password' => 'guest',
        );

        $connection = new \AMQPConnection($options);
        if (!$connection->connect()) {
            die("Cannot connect to the broker!\n");
        }

        // 通道
        $channelObj = new \AMQPChannel($connection);

        // 交换
        $exchangeObj = new \AMQPExchange($channelObj);
        $exchangeObj->setName('first');
        $exchangeObj->setType(AMQP_EX_TYPE_DIRECT); //direct类型


        $publishStatus = $exchangeObj->publish($messageBody, 'queue_route');
        echo "Send Message:" . $publishStatus . "\n";

        $connection->disconnect();
    }

}