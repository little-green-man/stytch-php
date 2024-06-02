<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\EmailMagicLinks;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;
use LittleGreenMan\StytchPHP\Resources\Member;
use LittleGreenMan\StytchPHP\Resources\MemberSession;
use LittleGreenMan\StytchPHP\Resources\MfaRequired;
use LittleGreenMan\StytchPHP\Resources\Organization;

class
AuthenticateMagicLinkResponse
{
    use StytchResponse;

    public function __construct(
        public int                    $status_code,
        public string                 $request_id,
        public string                 $member_id,
        public readonly string        $method_id,
        public readonly MemberSession $member_session,
        public readonly bool          $reset_sessions,
        public readonly string        $session_token,
        public readonly string        $session_jwt,
        public readonly string        $intermediate_session_token,
        public readonly bool          $member_authenticated,
        public readonly MfaRequired   $mfa_required,
        public readonly string        $organization_id,
        public Organization           $organization,
        public Member                 $member,
        public readonly ?string       $error_type,
        public readonly ?string       $error_message,
        public readonly ?string       $error_url,
    ) {}
}
