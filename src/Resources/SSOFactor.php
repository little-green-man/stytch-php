<?php

namespace LittleGreenMan\StytchPHP\Resources;

class SSOFactor
{
    public function __construct(
        public string $id,
        public string $provider_id,
        public string $external_id,
    ) {}
}
