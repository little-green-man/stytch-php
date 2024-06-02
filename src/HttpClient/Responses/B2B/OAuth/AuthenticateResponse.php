<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\OAuth;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;
use LittleGreenMan\StytchPHP\Resources\Member;
use LittleGreenMan\StytchPHP\Resources\MemberSession;
use LittleGreenMan\StytchPHP\Resources\MfaRequired;
use LittleGreenMan\StytchPHP\Resources\Organization;
use LittleGreenMan\StytchPHP\Resources\ProviderValues;

class AuthenticateResponse
{
    use StytchResponse;

    public function __construct(
        // Standard fields
        public string           $request_id,
        public int              $status_code,

        // Additional Fields
        public string           $intermediate_session_token,
        public Member           $member,
        public bool             $member_authenticated,
        public string           $member_id,
        public MfaRequired      $mfa_required,
        public string           $organization_id,
        public Organization     $organization,
        public string           $provider_subject,
        public string           $provider_type,
        public ProviderValues   $provider_values,
        public MemberSession    $member_session,
        public string           $session_token,
        public string           $session_jwt,

        // Errors
        public readonly ?string $error_type,
        public readonly ?string $error_message,
        public readonly ?string $error_url,
    ) {}
}
