<?php

namespace LittleGreenMan\StytchPHP\Resources;

class AuthenticationAppFactor
{
    public function __construct(
        public string $totp_id,
    ) {}
}
