<?php

namespace LittleGreenMan\StytchPHP;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use LittleGreenMan\StytchPHP\Endpoints\B2B\EmailMagicLinks;
use LittleGreenMan\StytchPHP\Endpoints\B2B\Members;
use LittleGreenMan\StytchPHP\Endpoints\B2B\Organizations;
use LittleGreenMan\StytchPHP\Endpoints\B2B\RBAC;

class StytchB2B
{
    protected ?string $memberSession = null;
    protected ?string $memberSessionJwt = null;
    private ClientBuilder $clientBuilder;

    public function __construct(ClientBuilder $clientBuilder )
    {
        $this->clientBuilder = $clientBuilder;
    }

    public function withMemberSession(string $memberSession): self
    {
        $this->memberSession = $memberSession;
        return $this;
    }

    public function withMemberSessionJwt(string $memberSessionJwt): self
    {
        $this->memberSessionJwt = $memberSessionJwt;
        return $this;
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        $additionalDefaultHeaders = [];

        if($this->memberSession !== null)
        {
            $additionalDefaultHeaders['X-Stytch-Member-Session'] = $this->memberSession;
        }

        if($this->memberSession !== null)
        {
            $additionalDefaultHeaders['X-Stytch-Member-SessionJWT'] = $this->memberSessionJwt;
        }

        return $this->clientBuilder->getHttpClient($additionalDefaultHeaders);
    }

    public function organizations(?string $organizationId = null): Organizations
    {
        return new Organizations($this, organizationId: $organizationId);
    }

    public function emailMagicLinks(): EmailMagicLinks
    {
        return new EmailMagicLinks($this);
    }

    public function rbac(): RBAC
    {
        return new RBAC($this);
    }
}
