<?php

namespace LittleGreenMan\StytchPHP\B2B;

use LittleGreenMan\StytchPHP\HttpClient\Message\ResponseMediator;
use LittleGreenMan\StytchPHP\StytchB2B;

class Organizations
{
    private StytchB2B $stytchB2B;

    public function __construct(StytchB2B $stytchB2B)
    {
        $this->stytchB2B = $stytchB2B;
    }

    public function create(string $name, string $slug)
    {
        return ResponseMediator::getContent(
            $this->stytchB2B->getHttpClient()->post("/b2b/organizations", body: json_encode([
                'organization_name' => $name,
                'organization_slug' => $slug,
            ]))
        );
    }

    public function search(?string $cursor = null, ?int $limit = null, ?object $query = null): array
    {
        $params = [];

        if ($cursor) {
            $params['cursor'] = $cursor;
        }

        if ($limit) {
            $params['limit'] = $limit;
        }

        if ($query) {
            $params['query'] = $query;
        }

        return ResponseMediator::getContent(
            $this->stytchB2B->getHttpClient()->post("/b2b/organizations/search", $params)
        )->organizations;
    }

    public function getById(string $id): array|object
    {
        return ResponseMediator::getContent(
            $this->stytchB2B->getHttpClient()->get("/b2b/organizations/{$id}")
        )->organization;
    }

    /**
     * @param string $id
     * @param array $data
     * @param string|null $memberSession
     * @param string|null $memberSessionJWT
     * @return array|object
     * @throws \Http\Client\Exception
     * Update an organization. See https://stytch.com/docs/b2b/api/update-organization for params.
     */
    public function update(string $id, array $data, ?string $memberSession = null, ?string $memberSessionJWT = null)
    {
        return ResponseMediator::getContent(
            $this->stytchB2B->getHttpClient()->put(
                uri: "/b2b/organizations/{$id}",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJWT,
                ],
                body: json_encode($data))
        );
    }

    public function delete(string $id, ?string $memberSession = null, ?string $memberSessionJWT = null)
    {
        return ResponseMediator::getContent(
            $this->stytchB2B
                ->getHttpClient()
                ->delete(
                    "/b2b/organizations/{$id}",
                    headers: [
                        'X-Stytch-Member-Session' => $memberSession,
                        'X-Stytch-Member-SessionJWT' => $memberSessionJWT,
                    ]
                )
        );
    }
}
