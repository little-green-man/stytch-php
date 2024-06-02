<?php

namespace LittleGreenMan\StytchPHP\Resources;

class SsoActiveConnection
{
    public function __construct(
        private readonly string $connection_id,
        private readonly string $display_name
    ) {}
}
