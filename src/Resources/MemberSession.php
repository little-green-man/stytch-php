<?php

namespace LittleGreenMan\StytchPHP\Resources;

class MemberSession
{
    /**
     * @param AuthenticationFactor[] $authentication_factors
     * @param object[] $custom_claims
     * @param string[] $roles
     */
    public function __construct(
        public readonly string $member_session_id,
        public readonly string $member_id,
        public readonly string $started_at, // ISO 8601
        public readonly string $last_accessed_at,// ISO 8601
        public readonly string $expires_at,// ISO 8601
        public readonly array  $authentication_factors,
        public readonly array  $custom_claims,
        public readonly string $organization_id,
        public readonly array  $roles,
    ) {}
}
