<?php

namespace LittleGreenMan\StytchPHP\Resources;

class PrimaryRequired
{
    public function __construct(
        public readonly array $allowed_auth_methods,
    ) {}
}
