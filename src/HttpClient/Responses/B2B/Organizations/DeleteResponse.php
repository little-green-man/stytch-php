<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\Organizations;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;

class DeleteResponse
{
    use StytchResponse;

    public function __construct(
        public int    $status_code,
        public string $request_id,
        public string $organization_id,
        public readonly ?string $error_type,
        public readonly ?string $error_message,
        public readonly ?string $error_url,
    ) {}
}
