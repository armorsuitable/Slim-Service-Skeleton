<?php
/**
 *
 */

namespace App\Contracts;

/**
 * Interface EventContract
 * @package App\Contracts
 */
interface EventContract
{
    /**
     *  事件处理操作，获取事件的数据, 事件的数据 （包括事件的来源， 传送目标等）
     * @param $message
     *
     * @return mixed
     */
    public function handle($message);
}