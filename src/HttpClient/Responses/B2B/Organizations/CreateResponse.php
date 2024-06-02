<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\Organizations;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;
use LittleGreenMan\StytchPHP\Resources\Organization;

class CreateResponse
{
    use StytchResponse;

    public function __construct(
        public readonly int           $status_code,
        public readonly string        $request_id,
        public readonly ?Organization $organization,
        public readonly ?string $error_type,
        public readonly ?string $error_message,
        public readonly ?string $error_url,
    ) {}
}
