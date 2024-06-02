<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\Members;

use LittleGreenMan\StytchPHP\HttpClient\Responses\Concerns\StytchResponse;
use LittleGreenMan\StytchPHP\Resources\Member;

class
SearchResponse
{
    use StytchResponse;

    /**
     * @param Member[]|null $members
     */
    public function __construct(
        public int              $status_code,
        public string           $request_id,
        public ?object          $results_metadata,
        public ?array           $members,
        public ?object          $organizations,
        public readonly ?string $error_type,
        public readonly ?string $error_message,
        public readonly ?string $error_url,
    ) {}
}
