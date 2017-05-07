<?php
/**
 *
 */

namespace App\Controllers;

use App\Contracts\EventContract;
use EasyWeChat\Core\Exceptions\InvalidConfigException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Slim\Views\Twig;


class IndexController extends Controller
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     */
    public function drive(ServerRequestInterface $request ,
                          ResponseInterface $response)
    {
        // 微信端服务对象
        $WeChatServer = $this->WeChat->server;
        // 事件处理对象
        $camelCase = $this->camelCase;

        $WeChatServer->setMessageHandler(function($message) use($camelCase){
            if($message->type == 'Event'){
                // 获取微信的事件处理类
                $eventHandler = $camelCase->getFullCamelCase($message->event);
                // 处理微信事件
                if(class_exists($eventHandler)
                    && $eventHandler instanceof EventContract){
                    return call_user_func_array([new $eventHandler,'handle'], $message);
                }

                throw new InvalidConfigException('Class 
                '.$eventHandler.' could not or ');
            }
        });
    }

    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->view->render($response,'home.twig');
    }
}