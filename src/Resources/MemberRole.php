<?php

namespace LittleGreenMan\StytchPHP\Resources;

class MemberRole
{
    /**
     * @param MemberRoleSource[] $sources
     */
    public function __construct(
        public readonly string $role_id,
        public readonly array $sources,
    ) {}
}
