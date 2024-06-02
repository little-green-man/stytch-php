<?php

namespace LittleGreenMan\StytchPHP\Endpoints\B2B;

use Http\Client\Exception;
use LittleGreenMan\StytchPHP\Exceptions\InvalidOrganizationSlugException;
use LittleGreenMan\StytchPHP\HttpClient\Responses;
use LittleGreenMan\StytchPHP\HttpClient\StytchResponseHandler;
use LittleGreenMan\StytchPHP\StytchB2B;

class EmailMagicLinks
{
    public readonly string $organizationId;
    protected ?string $memberSession = null;
    protected ?string $memberSessionJwt = null;

    public function __construct(private StytchB2B $stytchB2B, ?string $organizationId = null, $memberSession = null, $memberSessionJwt = null)
    {
        $this->organizationId = $organizationId;
        $this->memberSession = $memberSession;
        $this->memberSessionJwt = $memberSessionJwt;
    }

    public function sendLoginOrSignupEmail(string  $emailAddress,
                                           ?string $loginRedirectUrl = null,
                                           ?string $signupRedirectUrl = null,
                                           ?string $pkceCodeChallenge = null,
                                           ?string $loginTemplateId = null,
                                           ?string $signupTemplateId = null,
                                           ?string $locale = null,
                                           ?string $organizationId = null
    ): Responses\B2B\EmailMagicLinks\SendLoginOrSignupEmailResponse
    {

        if ($organizationId = $organizationId ?? $this->organizationId) {
            throw new \Exception('An organization ID is required');
        }

        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\EmailMagicLinks\SendLoginOrSignupEmailResponse::class,
            from: $this->stytchB2B->getHttpClient()->post(
                uri: "/b2b/magic_links/email/login_or_signup",
                body: json_encode([
                    'organization_id' => $organizationId,
                    'email_address' => $emailAddress,
                    'login_redirect_url' => $loginRedirectUrl,
                    'signup_redirect_url' => $signupRedirectUrl,
                    'pkce_code_challenge' => $pkceCodeChallenge,
                    'login_template_id' => $loginTemplateId,
                    'signup_template_id' => $signupTemplateId,
                    'locale' => $locale,
                ]))
        );
    }


    /**
     * @throws Exception
     * @throws InvalidOrganizationSlugException
     */
    public function sendInviteEmail(string  $emailAddress,
                                    ?string $inviteRedirectUrl = null,
                                    ?string $inviteTemplateId = null,
                                    ?string $invitedByMemberId = null,
                                    ?string $name = null,
                                    ?object $trustedMetadata = null,
                                    ?object $untrustedMetadata = null,
                                    ?string $locale = null,
                                    ?array  $roles = null,
                                    ?string $organizationId = null
    ): Responses\B2B\EmailMagicLinks\SendInviteEmailResponse
    {

        if ($organizationId = $organizationId ?? $this->organizationId) {
            throw new \Exception('An organization ID is required');
        }

        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\EmailMagicLinks\SendInviteEmailResponse::class,
            from: $this->stytchB2B->getHttpClient()->post(
                uri: "/b2b/magic_links/email/invite",
                headers: [
                    'X-Stytch-Member-Session' => $memberSession ?? $this->memberSession,
                    'X-Stytch-Member-SessionJWT' => $memberSessionJwt ?? $this->memberSessionJwt,
                ],
                body: json_encode([
                    'organization_id' => $organizationId,
                    'email_address' => $emailAddress,
                    'invite_redirect_url' => $inviteRedirectUrl,
                    'invite_template_id' => $inviteTemplateId,
                    'invited_by_member_id' => $invitedByMemberId,
                    'name' => $name,
                    'trusted_metadata' => $trustedMetadata,
                    'untrusted_metadata' => $untrustedMetadata,
                    'locale' => $locale,
                    'roles' => $roles,
                ]))
        );
    }


    public function authenticateMagicLink(string  $magicLinkToken,
                                          ?string $sessionToken = null,
                                          ?string $sessionJwt = null,
                                          ?string $intermediateSessionToken = null,
                                          ?int    $sessionDurationMinutes = null,
                                          ?string $pkceCodeVerifier = null,
                                          ?array  $sessionCustomClaims = null,
                                          ?string $locale = null,
    ): Responses\B2B\EmailMagicLinks\AuthenticateMagicLinkResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\EmailMagicLinks\AuthenticateMagicLinkResponse::class,
            from: $this->stytchB2B->getHttpClient()->post(
                uri: "/b2b/magic_links/authenticate",
                body: json_encode([
                    'magic_links_token' => $magicLinkToken,
                    'session_token' => $sessionToken ?? $this->memberSession,
                    'session_jwt' => $sessionJwt ?? $this->memberSessionJwt,
                    'intermediate_session_token' => $intermediateSessionToken,
                    'session_duration_minutes' => $sessionDurationMinutes,
                    'pkce_code_verifier' => $pkceCodeVerifier,
                    'session_custom_claims' => $sessionCustomClaims,
                    'locale' => $locale,
                ]))
        );
    }

    public function sendDiscoveryEmail(string  $emailAddress,
                                       ?string $discoveryRedirectUrl = null,
                                       ?string $pkceCodeChallenge = null,
                                       ?string $loginTemplateId = null,
                                       ?string $locale = null,
    ): Responses\B2B\EmailMagicLinks\SendDiscoveryEmailResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\EmailMagicLinks\SendDiscoveryEmailResponse::class,
            from: $this->stytchB2B->getHttpClient()->post(
                uri: "/b2b/magic_links/email/discovery/send",
                body: json_encode([
                    'email_address' => $emailAddress,
                    'discovery_redirect_url' => $discoveryRedirectUrl,
                    'pkce_code_challenge' => $pkceCodeChallenge,
                    'login_template_id' => $loginTemplateId,
                    'locale' => $locale,
                ]))
        );

    }


    public function authenticateDiscoveryMagicLink(string  $discoveryMagicLinksToken,
                                                   ?string $pkceCodeVerifier = null,
    ): Responses\B2B\EmailMagicLinks\AuthenticateDiscoveryMagicLinkResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\EmailMagicLinks\AuthenticateDiscoveryMagicLinkResponse::class,
            from: $this->stytchB2B->getHttpClient()->post(
                uri: "/b2b/magic_links/discovery/authenticate",
                body: json_encode([
                    'discovery_magic_links_token' => $discoveryMagicLinksToken,
                    'pkce_code_verifier' => $pkceCodeVerifier,
                ]))
        );
    }
}
