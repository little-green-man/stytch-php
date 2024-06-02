<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;
use LittleGreenMan\StytchPHP\Resources\Organization;

class OrganizationSearchResponse
{
    use StytchResponse;

    /**
     * @param Organization[] $organizations
     */
    public function __construct(
        public int              $status_code,
        public string           $request_id,
        public array            $organizations,
        public ?object          $results_metadata = null,
        public readonly ?string $error_type,
        public readonly ?string $error_message,
        public readonly ?string $error_url,
    ) {}
}
