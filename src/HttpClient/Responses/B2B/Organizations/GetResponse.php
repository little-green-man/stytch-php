<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\Organizations;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;
use LittleGreenMan\StytchPHP\Resources\Organization;

class GetResponse
{
    use StytchResponse;

    public function __construct(
        public int              $status_code,
        public string           $request_id,
        public ?Organization    $organization,
        public readonly ?string $error_type,
        public readonly ?string $error_message,
        public readonly ?string $error_url,
    ) {}
}
