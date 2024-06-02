<?php

namespace LittleGreenMan\StytchPHP\Resources;

class RBACPolicy
{
    /**
     * @param Resource[] $resources
     * @param PolicyRole[] $roles
     */
    public function __construct(
        private readonly array $resources,
        private readonly array $roles
    ) {}
}
