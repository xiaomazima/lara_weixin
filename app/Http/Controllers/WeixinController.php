<?php

namespace App\Http\Controllers;

use App\Model\WeixinUser;
use Illuminate\Http\Request;

class WeixinController extends Controller
{
    //获取access_token
    public function access_token(){
        $access=WeixinUser::getWXAccessToken();
        echo $access;
    }


    //接受服务器时间推送
    public function wxEvent(){
        $data = file_get_contents("php://input");
//            var_dump($data);die;

        //解析XML
        $xml = simplexml_load_string($data);        //将 xml字符串 转换成对象

        //记录日志
        $log_str = date('Y-m-d H:i:s') . "\n" . $data . "\n<<<<<<<";
        file_put_contents('logs/wx_event.log',$log_str,FILE_APPEND);



        $event = $xml->Event;                       //事件类型
//        var_dump($xml);echo '<hr>';die;
        $openid = $xml->FromUserName;               //用户openid

    }
}
