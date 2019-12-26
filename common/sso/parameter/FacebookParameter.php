<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/3
 * Time: 下午 01:53
 */

namespace common\sso\parameter;


use common\model\Parameter;

class FacebookParameter extends Parameter
{
    private static $instance;
    /**
     * @return static
     */
    public static function getInstance()
    {
        if (null == static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @return array
     */
    public function properties(): array
    {
        return [
            'appId',
            'appSecret',
        ];
    }
}
