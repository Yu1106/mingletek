<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/3
 * Time: 下午 02:40
 */

namespace common\sso;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 */
class LoginInformation
{
    public function properties(): array
    {
        return [
            'id',
            'name',
            'email'
        ];
    }
}
