<?php

namespace LittleGreenMan\StytchPHP\Endpoints\B2B;

use LittleGreenMan\StytchPHP\Exceptions\InvalidOrganizationSlugException;
use LittleGreenMan\StytchPHP\HttpClient\Responses;
use LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\OrganizationCreateResponse;
use LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\OrganizationDeleteResponse;
use LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\OrganizationGetResponse;
use LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\OrganizationSearchResponse;
use LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\OrganizationUpdateResponse;
use LittleGreenMan\StytchPHP\HttpClient\StytchResponseHandler;
use LittleGreenMan\StytchPHP\StytchB2B;

class Organizations
{
    public readonly ?string $organizationId;
    protected ?string $memberSession = null;
    protected ?string $memberSessionJwt = null;

    public function __construct(private StytchB2B $stytchB2B, $organizationId = null, $memberSession = null, $memberSessionJWT = null)
    {
        $this->organizationId = $organizationId;
        $this->memberSession = $memberSession;
        $this->memberSessionJwt = $memberSessionJWT;
    }

    public function members(): Members
    {
        return new Members($this->stytchB2B, $this->organizationId);
    }

    public function create(string $name, string $slug): OrganizationCreateResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: OrganizationCreateResponse::class,
            from: $this->stytchB2B->getHttpClient()->post("/b2b/organizations", body: json_encode([
                'organization_name' => $name,
                'organization_slug' => $slug,
            ]))
        );
    }


    public function search(?string $cursor = null, ?int $limit = null, ?object $query = null): OrganizationSearchResponse
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

        return StytchResponseHandler::hydrateClass(
            className: OrganizationSearchResponse::class,
            from: $this->stytchB2B->getHttpClient()->post("/b2b/organizations/search", body: json_encode($params))
        );
    }

    public function get(?string $organizationId = null): OrganizationGetResponse
    {
        $organizationId = $organizationId ?? $this->organizationId;
        return StytchResponseHandler::hydrateClass(
            className: OrganizationGetResponse::class,
            from: $this->stytchB2B->getHttpClient()->get("/b2b/organizations/{$organizationId}")
        );
    }

    /**
     * @param string $id
     * @param array $data
     * @param string|null $memberSession
     * @param string|null $memberSessionJWT
     * @return array|object
     * @throws \Http\Client\Exception
     * @throws InvalidOrganizationSlugException
     * Update an organization. See https://stytch.com/docs/b2b/api/update-organization for params.
     */
    public function update(array $data, ?string $organizationId = null, ?string $memberSession = null, ?string $memberSessionJWT = null): OrganizationUpdateResponse
    {
        $organizationId = $organizationId ?? $this->organizationId;

        return StytchResponseHandler::hydrateClass(
            className: OrganizationUpdateResponse::class,
            from: $this->stytchB2B->getHttpClient()->put(
                uri: "/b2b/organizations/{$organizationId}",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession ?? $this->memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJWT ?? $this->memberSessionJwt,
                ],
                body: json_encode($data))
        );
    }

    public function delete(?string $organizationId = null, ?string $memberSession = null, ?string $memberSessionJWT = null): OrganizationDeleteResponse
    {
        $organizationId = $organizationId ?? $this->organizationId;

        return StytchResponseHandler::hydrateClass(
            className: OrganizationDeleteResponse::class,
            from: $this->stytchB2B->getHttpClient()->delete(
                uri: "/b2b/organizations/{$organizationId}",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJWT,
                ])
        );
    }
}
