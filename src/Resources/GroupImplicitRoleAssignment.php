<?php

namespace LittleGreenMan\StytchPHP\Resources;

class GroupImplicitRoleAssignment
{
    public function __construct(
        public readonly string $group,
        public readonly string $role_id,
    ) {}
}
