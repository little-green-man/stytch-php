<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\EmailMagicLinks;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;

class
SendDiscoveryEmailResponse
{
    use StytchResponse;

    public function __construct(
        // Standard fields
        public string           $request_id,
        public int              $status_code,

        // Additional Fields
        // None

        // Errors
        public readonly ?string $error_type,
        public readonly ?string $error_message,
        public readonly ?string $error_url,
    ) {}
}
