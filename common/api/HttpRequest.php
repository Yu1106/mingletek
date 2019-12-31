<?php

namespace common\api;


use common\PropertyRecord;
use common\util\HttpUtil;
use common\util\ObjectUtil;

abstract class HttpRequest extends PropertyRecord implements HttpRequestInterface
{
    public $method = HttpUtil::METHOD_POST;
    protected $curlOption = HttpUtil::DEFAULT_OPTION;

    abstract protected function endpointBase(): string;

    abstract protected function endpoint(): string;

    abstract protected function getResponseClassName(): string;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

    }

    public function beforeSend()
    {

    }

    public function send()
    {
        $this->beforeSend();
        $result = HttpUtil::curl($this->getUrl(), ObjectUtil::object2array($this, $this->properties()), $this->method, $this->curlOption);
        var_dump($result);
        $responseClass = $this->getResponseClassName();
//        var_dump($this->getUrl(), ObjectUtil::object2array($this, $this->properties()), $this->method, $result);
//        exit;
        if (empty($responseClass)) {
            return $result;
        }
        $result = json_decode($result);
        if (is_array($result)) {
            $response = [];
            if (isset($responseClass::$indexKey) && !empty($responseClass::$indexKey) && is_string($responseClass::$indexKey)) {
                foreach ($result as $data) {
                    if (!empty($data)) {
                        $responseData = $this->applyResponseData($responseClass, $data);
                        $response[$responseData->{$responseClass::$indexKey}] = $responseData;
                    }
                }
            } else {
                foreach ($result as $data) {
                    if (!empty($data)) {
                        array_push($response, $this->applyResponseData($responseClass, $data));
                    }
                }
            }
        } else {
            $response = $this->applyResponseData($responseClass, $result);
        }
        return $response;
    }

    protected function getUrl()
    {
        return $this->endpointBase() . $this->endpoint();
    }

    /**
     * @param $responseClass
     * @param $data
     * @return PropertyRecord
     */
    protected function applyResponseData($responseClass, $data)
    {
        /**
         * @var $response PropertyRecord
         */
        $response = new $responseClass();
        foreach ($response->properties() as $f) {
            if (isset($data->$f)) {
                $response->$f = $data->$f;
            }
        }
        return $response;
    }
}