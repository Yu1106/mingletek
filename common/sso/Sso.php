<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/3
 * Time: 下午 02:10
 */

namespace common\sso;


use common\sso\vendor\facebook\FacebookLoginHelper;
use common\sso\vendor\google\GoogleLoginHelper;
use Exception;
use Facebook\Exceptions\FacebookSDKException;

class Sso
{
    public function login($vendor)
    {
        switch ($vendor) {
            case Vendor::FACEBOOK:
                $url = FacebookLoginHelper::handlePreLogin();
                header("Location:" . $url);
                break;
            case Vendor::GOOGLE:
                $url = GoogleLoginHelper::handlePreLogin();
                header("Location:" . $url);
                break;
            default:
                exit();
        }
    }

    public function facebookLoginResponse()
    {
        try {
            $userInformation = FacebookLoginHelper::getUserInformationFromCallback();
            return $userInformation;
        } catch (FacebookSDKException $e) {
            var_dump($e);
        }
    }

    public function GoogleLoginResponse()
    {
        try {
            $userInformation = GoogleLoginHelper::getUserInformationFromCallback();
            return $userInformation;
        } catch (Exception $e) {
            var_dump($e);
        }
    }
}
