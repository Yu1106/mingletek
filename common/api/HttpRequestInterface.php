<?php

namespace common\api;


interface HttpRequestInterface
{
    /**
     * @return HttpResponseInterface
     */
    public function send();
}