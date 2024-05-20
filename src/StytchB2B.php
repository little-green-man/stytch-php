<?php

namespace LittleGreenMan\StytchPHP;

use Http\Client\Common\HttpMethodsClientInterface;
use LittleGreenMan\StytchPHP\Endpoints\B2B\Organizations;

class StytchB2B
{
    private ClientBuilder $clientBuilder;

    public function __construct(ClientBuilder $clientBuilder )
    {
        $this->clientBuilder = $clientBuilder;
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }

    public function organizations(): Organizations
    {
        return new Organizations($this);
    }
}
