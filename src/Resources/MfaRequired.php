<?php

namespace LittleGreenMan\StytchPHP\Resources;

class MfaRequired
{
    public function __construct(
        public ?string $secondary_auth_initiated,
        public MemberOptions $member_options,
    ) {}
}
