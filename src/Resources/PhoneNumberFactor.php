<?php

namespace LittleGreenMan\StytchPHP\Resources;

class PhoneNumberFactor
{
    public function __construct(
        public string $phone_number,
        public string $phone_id,
    ) {}
}
