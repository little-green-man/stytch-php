<?php

namespace LittleGreenMan\StytchPHP\Resources;

class SCIMRegistration
{
    public function __construct(
        public readonly string $connection_id,
        public readonly string $registration_id,
        public readonly string $external_id,
        public readonly object $scim_attributes,
    ) {}
}
// toIso8601ZuluString
