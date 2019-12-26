<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/3
 * Time: 下午 02:24
 */

namespace common\sso\vendor\google;


use common\util\HttpUtil;

class GoogleLoginHelper
{
    /**
     * @return string redirect URL after done
     * @throws \Exception
     */
    public static function handlePreLogin()
    {
        $oauth = new GoogleOAuth();

        $redirectUri = HttpUtil::SSOUrl('?r=google');
        $url = $oauth->createAuthUrl($redirectUri);
        return $url;
    }

    /**
     * @return false|\novellink\sso\LoginInformation
     */
    public static function getUserInformationFromCallback()
    {
        $oauth = new GoogleOAuth();
        $redirectUri = HttpUtil::SSOUrl('?r=google');
        $accessToken = $oauth->getAccessToken($redirectUri);

        return $oauth->getLoginInformation($accessToken);
    }
}
