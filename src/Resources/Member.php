<?php

namespace LittleGreenMan\StytchPHP\Resources;

class Member
{
    protected $updatable = [
        'email_address', // string
        'name', // string
        'trusted_metadata', // object
        'untrusted_metadata', // object
        'is_breakglass', // boolean
        'mfa_phone_number', // string
        'mfa_enrolled', // boolean
        'default_mfa_method', // string
        'roles', // array<string>
        'preserve_existing_sessions', // boolean
    ];

    /**
     * @param string $organization_id
     * @param string $member_id
     * @param string $email_address
     * @param bool $email_address_verified
     * @param string $status
     * @param bool $mfa_enrolled
     * @param string $mfa_phone_number
     * @param bool $mfa_phone_number_verified
     * @param string $default_mfa_method
     * @param string $name
     * @param object $trusted_metadata
     * @param object $untrusted_metadata
     * @param SAMLConnection|OICDConnection[] $sso_registrations
     * @param OAuthRegistration[] $oauth_registrations
     * @param SCIMRegistration[] $scim_registrations
     * @param MemberRole[] $roles
     */
    public function __construct(
        public string $organization_id,
        public string $member_id,
        public string $email_address,
        public bool   $email_address_verified,
        public string $status,
        public bool   $mfa_enrolled,
        public string $mfa_phone_number,
        public bool   $mfa_phone_number_verified,
        public string $default_mfa_method,
        public string $name,
        public object $trusted_metadata,
        public object $untrusted_metadata,
        public array  $sso_registrations,
        public array  $oauth_registrations,
        public array  $scim_registrations,
        public string $member_password_id,
        public string $totp_registration_id,
        public bool   $is_breakglass,
        public array  $roles,
        public bool   $is_admin,
        public string $created_at,
        public string $updated_at,
    ) {}
}
