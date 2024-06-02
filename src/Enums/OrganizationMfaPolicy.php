<?php

namespace LittleGreenMan\StytchPHP\Enums;

enum OrganizationMfaPolicy: string
{
    case REQUIRED_FOR_ALL = "REQUIRED_FOR_ALL";
    case OPTIONAL = "OPTIONAL";
}
