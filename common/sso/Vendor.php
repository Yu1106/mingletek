<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/3
 * Time: 下午 01:51
 */

namespace common\sso;

class Vendor
{
    const FACEBOOK = 'facebook';
    const GOOGLE = 'google';

    const VENDOR_LIST = [
        self::FACEBOOK,
        self::GOOGLE,
    ];
}
