<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/3
 * Time: 下午 02:21
 */

namespace common\sso\vendor\facebook;


use common\util\HttpUtil;

class FacebookLoginHelper
{
    /**
     * @return string redirect URL after done
     * @throws \Exception
     */
    public static function handlePreLogin()
    {
        $oauth = new FacebookOAuth();

        $redirectUri = HttpUtil::SSOUrl('?r=facebook');
        $url = $oauth->createAuthUrl($redirectUri);
        return $url;
    }

    /**
     * @return \novellink\sso\LoginInformation
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public static function getUserInformationFromCallback()
    {
        $oauth = new FacebookOAuth();
        $redirectUri = HttpUtil::SSOUrl('?r=facebook');
        $accessToken = $oauth->getAccessToken($redirectUri);

        return $oauth->getLoginInformation($accessToken);
    }
}
