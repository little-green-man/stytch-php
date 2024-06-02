<?php

namespace LittleGreenMan\StytchPHP\Resources;

class Certificate
{
    public function __construct(
        public readonly string $certificate,
        public readonly string $created_at,
        public readonly string $expires_at,
        public readonly string $certificate_id,
        public readonly string $issuer,
    ) {}
}
