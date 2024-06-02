<?php

namespace LittleGreenMan\StytchPHP\Resources;

class SCIMConnection
{
    public function __construct(
        public string $organization_id,
        public string $connection_id,
        public string $status,
        public string $display_name,
        public string $idp,
        public string $base_url,
        public string $bearer_token,
        public string $bearer_token_last_four,
        public \DateTimeImmutable $bearer_token_expires_at, //2029-03-20T21:28:28Z
        public string $next_bearer_token,
        public \DateTimeImmutable $next_bearer_token_expires_at,//2029-03-20T21:28:28Z

    ) {}
}
// toIso8601ZuluString
