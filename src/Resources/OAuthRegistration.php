<?php

namespace LittleGreenMan\StytchPHP\Resources;

class OAuthRegistration
{

    public function __construct(
        public readonly string $provider_type,
        public readonly string $provider_subject,
        public readonly string $profile_picture_url,
        public readonly string $locale,
        public readonly string $member_oauth_registration_id,
    ) {}
}
