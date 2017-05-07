<?php
/**
 *
 */

namespace App\Controllers;

/**
 * Class Controller
 * @package App\Controllers
 */
abstract class Controller
{
    protected $container;

    /**
     * 依赖注入属性至容器
     * Controller constructor.
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     *  动态加载容器中的属性
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if($this->container->{$property}){
            return $this->container->{$property};
        }
    }
}