<?php

namespace LittleGreenMan\StytchPHP\Resources;

class Resource
{
    /**
     * @param string[] $actions
     */
    public function __construct(
        public readonly string $resourceId,
        public readonly ?string $description,
        public readonly array $actions
    ) {}
}
