<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\OAuth;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;
use LittleGreenMan\StytchPHP\Resources\DiscoveredOrganization;

class AuthenticateDiscoveryOAuthResponse
{
    use StytchResponse;

    /**
     * @param DiscoveredOrganization[] $discovered_organizations
     */
    public function __construct(
        // Standard fields
        public string           $request_id,
        public int              $status_code,

        // Additional Fields
        public string           $intermediate_session_token,
        public string           $email_address,
        public array            $discovered_organizations,

        // Errors
        public readonly ?string $error_type,
        public readonly ?string $error_message,
        public readonly ?string $error_url,
    ) {}
}
