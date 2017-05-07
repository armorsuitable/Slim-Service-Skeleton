<?php
/**
 *  Slim-Skeleton bootstrap
 */
require_once __DIR__ . '/../vendor/autoload.php';

$settings = require_once __DIR__ . '/../config/settings.php';

$app = new Slim\App($settings);

// 获取Slim\App 应用容器
$container = $app->getContainer();

// 注入 Slim\Twig 容器
$container['view'] = function ($container){
    $view = new \Slim\Views\Twig(__DIR__ . '/../resource/views',[
        'cache' => false,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    return $view;
};

$container['WeChat'] = function() use ($settings){
    return new \EasyWeChat\Foundation\Application(
        $settings['settings']['WeChat']);
};

/**
 *  处理事件大小写，转换至类名的依赖成员
 * @return \App\Events\Detection\CamelCase
 */
$container['camelCase'] = function(){
    return new \App\Events\Detection\CamelCase();
};

/**
 * @param $container
 * @return \App\Controllers\IndexController
 */
$container['IndexController'] = function($container){
    return new App\Controllers\IndexController($container);
};

require_once __DIR__ . '/../route/routes.php';