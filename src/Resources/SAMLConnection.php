<?php

namespace LittleGreenMan\StytchPHP\Resources;

class SAMLConnection
{
    /**
     * @param Certificate[] $signing_certificates
     * @param Certificate[] $verification_certificates
     * @param ImplicitRoleAssignment[] $saml_connection_implicit_role_assignments
     * @param GroupImplicitRoleAssignment[] $saml_group_implicit_role_assignments
     */
    public function __construct(
        public readonly string $organization_id,
        public readonly string $connection_id,
        public readonly string $display_name,
        public readonly string $acs_url,
        public readonly string $audience_uri,
        public readonly AttributeMapping $attribute_mapping,
        public readonly string $idp_entity_id,
        public readonly string $alternative_audience_uri,
        public readonly string $idp_sso_url,
        public readonly array  $signing_certificates,
        public readonly array  $verification_certificates,
        public readonly array  $saml_connection_implicit_role_assignments,
        public readonly array  $saml_group_implicit_role_assignments,
        public readonly string $identity_provider,
        public readonly string $status,
    ) {}
}
