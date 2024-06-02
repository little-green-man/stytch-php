<?php

namespace LittleGreenMan\StytchPHP\Enums;

enum OrganizationEmailInvites: string
{
    case ALL_ALLOWED = "ALL_ALLOWED";
    case RESTRICTED = "RESTRICTED";
    case NONE = "NONE";
}
