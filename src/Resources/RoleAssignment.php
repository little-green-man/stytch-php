<?php

namespace LittleGreenMan\StytchPHP\Resources;

class RoleAssignment
{
    public function __construct(
        private readonly string $domain,
        private readonly string $role_id
    ) {}
}
