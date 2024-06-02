<?php

namespace LittleGreenMan\StytchPHP\Endpoints\B2B;

use LittleGreenMan\StytchPHP\Exceptions\InvalidOrganizationSlugException;
use LittleGreenMan\StytchPHP\HttpClient\Responses;
use LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\MemberCreateResponse;
use LittleGreenMan\StytchPHP\HttpClient\Responses\B2B\MemberSearchResponse;
use LittleGreenMan\StytchPHP\HttpClient\StytchResponseHandler;
use LittleGreenMan\StytchPHP\StytchB2B;

class Members
{
    public ?string $organizationId = null;
    protected ?string $memberSession = null;
    protected ?string $memberSessionJwt = null;

    public function __construct(private StytchB2B $stytchB2B, ?string $organizationId = null, $memberSession = null, $memberSessionJwt = null)
    {
        $this->organizationId = $organizationId;
        $this->memberSession = $memberSession;
        $this->memberSessionJwt = $memberSessionJwt;
    }

    public function create(array $data, ?string $organizationId, ?string $memberSession = null, ?string $memberSessionJwt = null): MemberCreateResponse
    {
        $organizationId = $organizationId ?? $this->organizationId;

        return StytchResponseHandler::hydrateClass(
            className: MemberCreateResponse::class,
            from: $this->stytchB2B->getHttpClient()->post(
                uri: "/b2b/organizations/{$organizationId}/members",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession ?? $this->memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJwt ?? $this->memberSessionJwt,
                ],
                body: json_encode($data),
            )
        );
    }


    public function search(?array $organizationIds = null, ?string $cursor = null, ?int $limit = null, ?object $query = null, ?string $memberSession = null, ?string $memberSessionJwt = null): MemberSearchResponse
    {
        $organizationIds = $organizationIds ?? [$this->organizationId];

        $params = [
            'organization_ids' => $organizationIds ?? [$this->organizationId],
        ];

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
            className: MemberSearchResponse::class,
            from: $this->stytchB2B->getHttpClient()->post(
                uri: "/b2b/organizations/members/search",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession ?? $this->memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJwt ?? $this->memberSessionJwt,
                ],
                body: json_encode($params)
            )
        );
    }

    public function get(?string $memberId = null, ?string $emailAddress = null, ?string $organizationId = null): Responses\B2B\MemberGetResponse
    {
        if ($memberId == null && $emailAddress == null) {
            throw new \InvalidArgumentException('You must provide either an id or an email');
        }

        $organizationId = $organizationId ?? $this->organizationId;

        $query = http_build_query([
            'member_id' => $memberId,
            'email_address' => $emailAddress,
        ]);

        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\MemberGetResponse::class,
            from: $this->stytchB2B->getHttpClient()
                ->get("/b2b/organizations/{$organizationId}/member?{$query}")
        );
    }

    /**
     * @param string $id
     * @param array $data
     * @param string|null $memberSession
     * @param string|null $memberSessionJwt
     * @return array|object
     * @throws \Http\Client\Exception
     * @throws InvalidOrganizationSlugException
     * Update an organization. See https://stytch.com/docs/b2b/api/update-organization for params.
     */
    public function update(string $id, array $data, ?string $organizationId = null, ?string $memberSession = null, ?string $memberSessionJwt = null): Responses\B2B\MemberUpdateResponse
    {
        $organizationId = $organizationId ?? $this->organizationId;

        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\MemberUpdateResponse::class,
            from: $this->stytchB2B->getHttpClient()->put(
                uri: "/b2b/organizations/{$organizationId}/members/{$id}",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession ?? $this->memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJwt ?? $this->memberSessionJwt,
                ],
                body: json_encode($data))
        );
    }

    public function reactivate(string $id, ?string $organizationId = null, ?string $memberSession = null, ?string $memberSessionJwt = null): Responses\B2B\MemberReactivateResponse
    {
        $organizationId = $organizationId ?? $this->organizationId;

        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\MemberReactivateResponse::class,
            from: $this->stytchB2B->getHttpClient()->put(
                uri: "/b2b/organizations/{$organizationId}/members/{$id}/reactivate",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession ?? $this->memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJwt ?? $this->memberSessionJwt,
                ]
            )
        );
    }

    public function delete(string $memberId, ?string $organizationId = null, ?string $memberSession = null, ?string $memberSessionJwt = null): Responses\B2B\MemberDeleteResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\MemberDeleteResponse::class,
            from: $this->stytchB2B->getHttpClient()->delete(
                uri: "/b2b/organizations/{$organizationId}/members/{$memberId}",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJwt,
                ])
        );
    }

    public function deletePassword(string $passwordId, ?string $organizationId = null, ?string $memberSession = null, ?string $memberSessionJwt = null): Responses\B2B\MemberDeletePasswordResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\MemberDeletePasswordResponse::class,
            from: $this->stytchB2B->getHttpClient()->delete(
                uri: "/b2b/organizations/{$organizationId}/members/passwords/{$passwordId}",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJwt,
                ])
        );
    }

    public function deleteMFAPhoneNumber(string $memberId, ?string $organizationId = null, ?string $memberSession = null, ?string $memberSessionJwt = null): MemberDeleteMFAPhoneNumberResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\MemberDeleteMFAPhoneNumberResponse::class,
            from: $this->stytchB2B->getHttpClient()->delete(
                uri: "/b2b/organizations/{$organizationId}/members/mfa_phone_numbers/{$memberId}",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJwt,
                ])
        );
    }

    public function deleteMFATOTP(string $memberId, ?string $organizationId = null, ?string $memberSession = null, ?string $memberSessionJwt = null): Responses\B2B\MemberDeleteMFATOTPResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\MemberDeleteMFATOTPResponse::class,
            from: $this->stytchB2B->getHttpClient()->delete(
                uri: "/b2b/organizations/{$organizationId}/members/{$memberId}/totp",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJwt,
                ])
        );
    }
}
