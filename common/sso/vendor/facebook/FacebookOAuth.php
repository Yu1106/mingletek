<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/3
 * Time: 下午 02:26
 */

namespace common\sso\vendor\facebook;


use common\sso\LoginInformation;
use common\sso\parameter\FacebookParameter;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

class FacebookOAuth
{
    public $appId;
    public $appSecret;

    private $fb;

    public function __construct()
    {
        if ($this->appId == '' || $this->appSecret == '') {
            $parameter = FacebookParameter::getInstance();
            if ($this->appId == '') {
                $this->appId = $parameter->appId;
            }

            if ($this->appSecret == '') {
                $this->appSecret = $parameter->appSecret;
            }
        }

        $this->fb = new Facebook([
            'app_id' => $this->appId,
            'app_secret' => $this->appSecret,
        ]);
    }

    /**
     * @return Facebook
     */
    public function getFB()
    {
        return $this->fb;
    }

    public function createAuthUrl(string $redirectUri, array $permissions = ['email', 'public_profile'])
    {
        $helper = $this->fb->getRedirectLoginHelper();
		$helper->getPersistentDataHandler()->set('state', \Volnix\CSRF\CSRF::getToken('state')); // 所以可以在此帶值進去
        return $helper->getLoginUrl($redirectUri, $permissions);
    }

    /**
     * @param string $redirectUri
     * @return string
     * @throws FacebookSDKException
     */
    public function getAccessToken(string $redirectUri)
    {
        $helper = $this->fb->getRedirectLoginHelper();
        if (isset($_GET['state'])) {
            $helper->getPersistentDataHandler()->set('state', $_GET['state']);
        }
        $accessToken = $helper->getAccessToken($redirectUri);

        return $accessToken->getValue();
    }

    /**
     * @param $accessToken
     * @return LoginInformation
     */
    public function getLoginInformation($accessToken)
    {
        try {
            $response = $this->fb->get('/me?fields=id,name,email', $accessToken);
            $user = $response->getGraphUser();
            $loginInformation = new LoginInformation();
            $loginInformation->id = $user->getId();
            $loginInformation->name = $user->getName();
            $loginInformation->email = $user->getEmail();

            return $loginInformation;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

    }
}
