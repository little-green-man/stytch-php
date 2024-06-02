<?php

namespace LittleGreenMan\StytchPHP\Resources;

use LittleGreenMan\StytchPHP\Enums\AuthMethod;
use LittleGreenMan\StytchPHP\Enums\OrganizationEmailInvites;
use LittleGreenMan\StytchPHP\Enums\OrganizationEmailJitProvisioning;
use LittleGreenMan\StytchPHP\Enums\OrganizationMfaPolicy;
use LittleGreenMan\StytchPHP\Enums\SsoJitProvisioning;
use LittleGreenMan\StytchPHP\Resources\Concerns\CanBePreparedForStytch;

/**
 * Organization DTO for object defined in https://stytch.com/docs/b2b/api/organization-object
 */
class Organization
{
    use CanBePreparedForStytch;

    protected array $blockedCommonEmailDomains = ['gmail', 'aol', 'yahoo', 'icloud', 'hotmail', 'msn', 'comcast', 'live', 'outlook', 'att', 'earthlink', 'me', 'mac', 'sbcglobal', 'verizon', 'ig', 'mail', 'hey', 'laposte', 'wanadoo', 'googlemail', 'orange', 'rediffmail', 'uol', 'bol', 'free', 'gmx', 'yandex', 'ymail', 'libero'];
    public static array $allowedAuthMethodsSet = ['sso', 'magic_link', 'password', 'google_oauth', 'microsoft_oauth'];

    /**
     * @param string[] $email_allowed_domains
     * @param RoleAssignment[] $rbac_email_implicit_role_assignments
     * @param string[] $sso_jit_provisioning_allowed_connections
     * @param SsoActiveConnection[] $sso_active_connections
     * @param ScimActiveConnection[] $scim_active_connections
     * @param string[] $allowed_auth_methods
     * @param string[] $allowed_mfa_methods
     */
    public function __construct(
        public string                            $organization_id,
        public string                            $organization_name,
        public ?string                           $organization_slug = null,
        public ?string                           $organization_logo_url = null,
        public ?array                            $email_allowed_domains = null,
        public ?OrganizationEmailInvites         $email_invites = null,
        public ?OrganizationEmailJitProvisioning $email_jit_provisioning = null,
        public ?OrganizationMfaPolicy            $mfa_policy = null,
        public ?array                            $rbac_email_implicit_role_assignments = null,
        public ?string                           $sso_default_connection_id = null,
        public ?SsoJitProvisioning               $sso_jit_provisioning = null,
        public ?array                            $sso_jit_provisioning_allowed_connections = null,
        public ?array                            $sso_active_connections = null,
        public ?array                            $scim_active_connections = null,
        public ?AuthMethod                       $auth_methods = null,
        public ?array                            $allowed_auth_methods = null,
        public ?\stdClass                        $trusted_metadata = null,
        public ?string                           $mfa_methods = null,
        public ?array                            $allowed_mfa_methods = null,
        public ?string                           $created_at = null, // Iso8601
        public ?string                           $updated_at = null, // Iso8601
    ) {}
}
