<?php

namespace LittleGreenMan\StytchPHP\Resources;

class OICDConnection
{

    public function __construct(
        public readonly string $organization_id,
        public readonly string $connection_id,
        public readonly string $display_name,
        public readonly string $redirect_url,
        public readonly string $status,
        public readonly string $issuer,
        public readonly string $client_id,
        public readonly string $client_secret,
        public readonly string $authorization_url,
        public readonly string $token_url,
        public readonly string $userinfo_url,
        public readonly string $jwks_url,
        public readonly string $identity_provider,
    ) {}
}
