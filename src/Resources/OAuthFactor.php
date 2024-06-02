<?php

namespace LittleGreenMan\StytchPHP\Resources;

class OAuthFactor
{
    public function __construct(
        public string $id,
        public string $email_id,
        public string $provider_subject,
    ) {}
}
