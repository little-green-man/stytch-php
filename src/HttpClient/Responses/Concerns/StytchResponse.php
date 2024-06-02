<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns;

trait StytchResponse
{
    public readonly ?string $error_type;
    public readonly ?string $error_message;
    public readonly ?string $error_url;

    public function wasSuccessful(): bool
    {
        return $this->status_code >= 200 && $this->status_code < 300;
    }
}
