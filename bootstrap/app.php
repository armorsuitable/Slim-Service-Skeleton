<?php
/**
 *  Slim-Skeleton 启动文件
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

/**
 * @param $container
 * @return \App\Controllers\IndexController
 */
$container['IndexController'] = function($container){
    return new App\Controllers\IndexController($container);
};

require_once __DIR__ . '/../route/routes.php';