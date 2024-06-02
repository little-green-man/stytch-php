<?php

namespace LittleGreenMan\StytchPHP\Resources;

class AttributeMapping
{
    public function __construct(
        public readonly string $email,
        public readonly string $full_name,
        public readonly string $groups
    ) {}
}
