<?php
/**
 *  Slim-Skeleton bootstrap
 */
require_once __DIR__ . '/../vendor/autoload.php';

$settings = require_once __DIR__ . '/../config/settings.php';

$app = new Slim\App($settings);

// 获取Slim\App 应用容器
$container = $app->getContainer();

// 依赖注入 illuminate Eloquent ORM库
$capsule = new Illuminate\Database\Capsule\Manager;
// 配置 Eloquent
$capsule->addConnection($settings['settings']['db']);
$capsule->setAsGlobal();

// 启动 Eloquent
$capsule->bootEloquent();

$container['db'] = function($container) use($capsule){
    return $capsule;
};

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