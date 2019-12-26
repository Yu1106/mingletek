<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/3
 * Time: 下午 02:26
 */

namespace common\sso\vendor\google;


use common\sso\LoginInformation;
use common\sso\parameter\GoogleParameter;
use Firebase\JWT\JWT;
use Google_Client;
use Google_Service_Oauth2;

class GoogleOAuth
{
    public $clientId;
    public $clientSecret;

    private $google;

    public function __construct()
    {
        if ($this->clientId == '' || $this->clientSecret == '') {
            $parameter = GoogleParameter::getInstance();

            if ($this->clientId == '') {
                $this->clientId = $parameter->clientId;
            }

            if ($this->clientSecret == '') {
                $this->clientSecret = $parameter->clientSecret;
            }
        }

        $jwt = new JWT;
        $jwt::$leeway = 5;

        $this->google = new Google_Client([
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);
        $this->google->setAccessType('offline');
        $this->google->setIncludeGrantedScopes(true);
    }

    /**
     * @return Google_Client
     */
    public function getGoogle()
    {
        return $this->google;
    }

    public function createAuthUrl(string $redirectUri, array $scopes = [Google_Service_Oauth2::USERINFO_PROFILE, Google_Service_Oauth2::USERINFO_EMAIL])
    {
		$this->google->setState(\Volnix\CSRF\CSRF::getToken('state'));
        $this->google->setScopes($scopes);
        $this->google->setRedirectUri($redirectUri);
        return $this->google->createAuthUrl();
    }

    public function getAccessToken(string $redirectUri)
    {
        $this->google->setRedirectUri($redirectUri);
        $this->google->fetchAccessTokenWithAuthCode($_GET['code']);

        return $this->google->getAccessToken();
    }

    /**
     * @param array $accessToken
     * @return LoginInformation|false
     */
    public function getLoginInformation($accessToken)
    {
        $this->google->setAccessToken($accessToken);
        $payload = $this->google->verifyIdToken();

        if ($payload && in_array(['aud', 'sub', 'email', 'name'], $payload) && $payload['aud'] == $this->clientId) {
            $loginInformation = new LoginInformation();
            $loginInformation->id = $payload['sub'];
            $loginInformation->email = $payload['email'];
            $loginInformation->name = $payload['name'];

            return $loginInformation;
        } else {
            return false;
        }
    }
}
