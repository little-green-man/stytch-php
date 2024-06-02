<?php

namespace LittleGreenMan\StytchPHP\Resources;

class ScimActiveConnection
{
    public function __construct(
        private readonly string $connectionId,
        private readonly string $displayName
    )
    {}
}
