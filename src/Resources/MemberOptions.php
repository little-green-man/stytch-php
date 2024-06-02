<?php

namespace LittleGreenMan\StytchPHP\Resources;

class MemberOptions
{
    public function __construct(
        public string $mfa_phone_number,
        public string $totp_registration_id,
    ) {}
}
