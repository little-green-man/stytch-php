<?php

namespace LittleGreenMan\StytchPHP\Resources;

class Membership
{
    public function __construct(
        // 'active_member', 'pending_member', 'invited_member', or 'eligible_to_join_by_email_domain'
        public readonly string $type,
        public readonly Member $member,
        public readonly object $details,
    ) {}
}
