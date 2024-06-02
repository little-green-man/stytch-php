<?php

namespace LittleGreenMan\StytchPHP\Resources;

class MemberRoleSource
{
    public function __construct(
        public readonly string $type,
        public readonly object $details,
    ) {}
}
