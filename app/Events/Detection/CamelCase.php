<?php
/**
 *
 */

namespace App\Events\Detection;


class CamelCase
{
    /**
     *  去除下划线和小写转换
     * @param $eventName
     * @return mixed
     */
    public function getCamelCase($eventName)
    {
        return str_replace(' ','', ucwords(str_replace('_',' ',$eventName)));
    }

    /**
     *  获取事件完整的命名空间和类名
     * @param $eventName
     * @return string
     */
    public function getFullCamelCase($eventName)
    {
        $className = $this->getCamelCase($eventName);
        $withNameSpaceClass = "\\App\\Events\\WeChat\\".$className;

        return $withNameSpaceClass;
    }
}