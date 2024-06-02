<?php

namespace LittleGreenMan\StytchPHP\Enums;

enum AuthMethod: string
{
    //ALL_ALLOWED – the default setting which allows all authentication methods to be used.
    //RESTRICTED – only methods that comply with allowed_auth_methods can be used for authentication. This setting does not apply to Members with is_breakglass set to true.

    case ALL_ALLOWED = "ALL_ALLOWED";
    case RESTRICTED = "RESTRICTED";
}
