<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\EmailMagicLinks;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;
use LittleGreenMan\StytchPHP\Resources\Member;
use LittleGreenMan\StytchPHP\Resources\Organization;

class
SendLoginOrSignupEmailResponse
{
    use StytchResponse;

    public function __construct(
        public int              $status_code,
        public string           $request_id,
        public string           $member_id,
        public bool             $member_created,
        public Organization     $organization,
        public Member           $member,
        public readonly ?string $error_type,
        public readonly ?string $error_message,
        public readonly ?string $error_url,
    ) {}
}
