<?php

namespace LittleGreenMan\StytchPHP\Enums;

enum SsoJitProvisioning: string
{
    case ALL_ALLOWED = "ALL_ALLOWED";
    case RESTRICTED = "RESTRICTED";
    case NOT_ALLOWED = "NOT_ALLOWED";
}
// ALL_ALLOWED – new Members will be automatically provisioned upon successful authentication via any of the Organization's sso_active_connections.
//RESTRICTED – only new Members with SSO logins that comply with sso_jit_provisioning_allowed_connections can be provisioned upon authentication.
//NOT_ALLOWED – disable JIT provisioning via SSO.
