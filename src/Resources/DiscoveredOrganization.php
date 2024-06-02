<?php

namespace LittleGreenMan\StytchPHP\Resources;

class DiscoveredOrganization
{
    public function __construct(
        public readonly Organization $organization,
        public readonly Membership $membership,
        public readonly bool   $member_authenticated,
        public readonly PrimaryRequired $primary_required,
        public readonly MfaRequired $mfa_required,
    ) {}
}
