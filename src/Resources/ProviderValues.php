<?php

namespace LittleGreenMan\StytchPHP\Resources;

class ProviderValues
{
    public function __construct(
        public readonly string $access_token,
        public readonly string $refresh_token,
        public readonly string $id_token,
        public readonly array  $scopes,
    ) {}
}
