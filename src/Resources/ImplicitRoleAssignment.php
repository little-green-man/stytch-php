<?php

namespace LittleGreenMan\StytchPHP\Resources;

class ImplicitRoleAssignment
{
    public function __construct(
        public readonly string $role_id,
    ) {}
}
