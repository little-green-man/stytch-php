<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;
use LittleGreenMan\StytchPHP\Resources\Member;
use LittleGreenMan\StytchPHP\Resources\RBACPolicy;

class
RBACGetPolicyResponse
{
    use StytchResponse;

    /**
     * @param Member[]|null $members
     */
    public function __construct(
        public int              $status_code,
        public string           $request_id,
        public RBACPolicy       $policy,
        public readonly ?string $error_type,
        public readonly ?string $error_message,
        public readonly ?string $error_url,
    ) {}
}
