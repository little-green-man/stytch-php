<?php

namespace LittleGreenMan\StytchPHP\Resources;

class PolicyRole
{
    /**
     * @param null|Resource[] $permissions
     */
    public function __construct(
        public readonly string $role_id,
        public readonly ?string $description,
        public readonly ?array $permissions,
    ) {}
}
