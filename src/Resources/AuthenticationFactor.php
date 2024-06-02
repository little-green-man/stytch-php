<?php

namespace LittleGreenMan\StytchPHP\Resources;

class AuthenticationFactor
{
    /**
     * @param array $authentication_factors
     * @param object[] $custom_claims
     * @param string[] $roles
     */
    public function __construct(
        public string                   $type,
        public string                   $delivery_method,
        public string                   $created_at, //ISO 8601
        public string                   $last_authenticated_at,//ISO 8601
        public string                   $updated_at,//ISO 8601
        public string                   $sequence_order,
        public ?EmailFactor             $email_factor,
        public ?PhoneNumberFactor       $phone_number_factor,
        public ?OAuthFactor             $google_oauth_factor,
        public ?OAuthFactor             $microsoft_oauth_factor,
        public ?SSOFactor               $saml_sso_factor,
        public ?SSOFactor               $oidc_sso_factor,
        public ?AuthenticationAppFactor $authenticator_app_factor,
    ) {}
}
