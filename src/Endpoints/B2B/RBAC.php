<?php

namespace LittleGreenMan\StytchPHP\Endpoints\B2B;

use LittleGreenMan\StytchPHP\HttpClient\Responses;
use LittleGreenMan\StytchPHP\HttpClient\StytchResponseHandler;
use LittleGreenMan\StytchPHP\StytchB2B;

class RBAC
{
    public function __construct(private StytchB2B $stytchB2B) {}

    public function getPolicy(): Responses\B2B\RBAC\GetPolicyResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\RBAC\GetPolicyResponse::class,
            from: $this->stytchB2B->getHttpClient()->get("/b2b/rbac/policy")
        );
    }
}
