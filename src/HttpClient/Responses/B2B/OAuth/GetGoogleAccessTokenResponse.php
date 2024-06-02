<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\OAuth;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;
use LittleGreenMan\StytchPHP\Resources\DiscoveredOrganization;

class GetGoogleAccessTokenResponse
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
        public string           $provider_type,
        public string           $provider_subject,
        public string           $access_token,
        public int              $access_token_expires_in,
        public string           $id_token,
        public string           $refresh_token,
        public array            $scopes,

        // Errors
        public readonly ?string $error_type,
        public readonly ?string $error_message,
        public readonly ?string $error_url,
    ) {}
}
