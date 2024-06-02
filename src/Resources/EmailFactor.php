<?php

namespace LittleGreenMan\StytchPHP\Resources;

class EmailFactor
{
    public function __construct(
        public string $email_address,
        public string $email_id,
    ) {}
}
