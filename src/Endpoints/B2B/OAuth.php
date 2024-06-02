<?php

namespace LittleGreenMan\StytchPHP\Endpoints\B2B;

use LittleGreenMan\StytchPHP\HttpClient\Responses;
use LittleGreenMan\StytchPHP\HttpClient\StytchResponseHandler;
use LittleGreenMan\StytchPHP\StytchB2B;

class OAuth
{
    public function __construct(private StytchB2B $stytchB2B) {}

    /**
     * Endpoint to authenticate a user with an OAuth token.
     * https://stytch.com/docs/b2b/api/authenticate-oauth
     */
    public function Authenticate(
        string $oauth_token,
        array  $session_custom_claims,
        int    $session_duration_minutes,
        string $session_jwt,
        string $session_token,
        string $intermediate_session_token,
        string $pkce_code_verifier,
        string $locale
    ): Responses\B2B\OAuth\AuthenticateResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\OAuth\AuthenticateResponse::class,
            from: $this->stytchB2B->getHttpClient()->post(
                uri: "/b2b/oauth/authenticate",
                body: json_encode([
                    'oauth_token' => $oauth_token,
                    'session_custom_claims' => $session_custom_claims,
                    'session_duration_minutes' => $session_duration_minutes,
                    'session_jwt' => $session_jwt,
                    'session_token' => $session_token,
                    'intermediate_session_token' => $intermediate_session_token,
                    'pkce_code_verifier' => $pkce_code_verifier,
                    'local' => $locale
                ])
            )
        );
    }

    public function authenticateDiscoveryOAuth(
        string $discovery_oauth_token,
        string $pkce_code_verifier
    ): Responses\B2B\OAuth\AuthenticateDiscoveryOAuthResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\OAuth\AuthenticateDiscoveryOAuthResponse::class,
            from: $this->stytchB2B->getHttpClient()->post(
                uri: "/b2b/oauth/discovery/authenticate",
                body: json_encode([
                    'discovery_oauth_token' => $discovery_oauth_token,
                    'pkce_code_verifier' => $pkce_code_verifier,
                ])
            )
        );
    }

    public function getGoogleAccessToken(
        string $organization_id,
        string $member_id,
        bool   $include_refresh_token = false
    ): Responses\B2B\OAuth\GetGoogleAccessTokenResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\OAuth\GetGoogleAccessTokenResponse::class,
            from: $this->stytchB2B->getHttpClient()->get(
                uri: "/b2b/organizations/{$organization_id}/members/{$member_id}/oauth_providers/google?include_refresh_token={$include_refresh_token}",
            )
        );
    }

    public function getMicrosoftAccessToken(
        string $organization_id,
        string $member_id,
        bool   $include_refresh_token = false
    ): Responses\B2B\OAuth\GetMicrosoftAccessTokenResponse
    {
        return StytchResponseHandler::hydrateClass(
            className: Responses\B2B\OAuth\GetMicrosoftAccessTokenResponse::class,
            from: $this->stytchB2B->getHttpClient()->get(
                uri: "/b2b/organizations/{$organization_id}/members/{$member_id}/oauth_providers/microsoft?include_refresh_token={$include_refresh_token}",
            )
        );
    }

    public function getLoginWithGoogleURL(
        string $public_token,
        string $organization_id,
        string $slug,
        string $login_redirect_url,
        string $signup_redirect_url,
        string $custom_scopes,
        array  $provider_parameters,
        string $pkce_code_challenge,
    ): string
    {
        $query = http_build_query([
            "public_token" => $public_token,
            "organization_id" => $organization_id,
            "slug" => $slug,
            "login_redirect_url" => $login_redirect_url,
            "signup_redirect_url" => $signup_redirect_url,
            "custom_scopes" => $custom_scopes,
            ...$provider_parameters,
            "pkce_code_challenge" => $pkce_code_challenge,
        ]);

        return "https://test.stytch.com/v1/b2b/public/oauth/google/start?" . $query;
    }

    public function getLoginWithMicrosoftURL(
        string $public_token,
        string $organization_id,
        string $organization_slug,
        string $login_redirect_url,
        string $signup_redirect_url,
        string $custom_scopes,
        array  $provider_parameters,
        string $pkce_code_challenge,
    ): string
    {
        $query = http_build_query([
            "public_token" => $public_token,
            "organization_id" => $organization_id,
            "organization_slug" => $organization_slug,
            "login_redirect_url" => $login_redirect_url,
            "signup_redirect_url" => $signup_redirect_url,
            "custom_scopes" => $custom_scopes,
            ...$provider_parameters,
            "pkce_code_challenge" => $pkce_code_challenge,
        ]);

        return "https://test.stytch.com/v1/b2b/public/oauth/microsoft/start?" . $query;
    }

    public function getStartGoogleDiscoveryOAuthFlowURL(
        string $public_token,
        string $discovery_redirect_url,
        string $custom_scopes,
        array  $provider_parameters,
        string $pkce_code_challenge,
    ): string
    {
        $query = http_build_query([
            "public_token" => $public_token,
            "discovery_redirect_url" => $discovery_redirect_url,
            "custom_scopes" => $custom_scopes,
            ...$provider_parameters,
            "pkce_code_challenge" => $pkce_code_challenge,
        ]);

        return "https://test.stytch.com/v1/b2b/public/oauth/google/discovery/start?" . $query;
    }

    public function getStartMicrosoftDiscoveryOAuthFlowURL(
        string $public_token,
        string $discovery_redirect_url,
        string $custom_scopes,
        array  $provider_parameters,
        string $pkce_code_challenge,
    ): string
    {
        $query = http_build_query([
            "public_token" => $public_token,
            "discovery_redirect_url" => $discovery_redirect_url,
            "custom_scopes" => $custom_scopes,
            ...$provider_parameters,
            "pkce_code_challenge" => $pkce_code_challenge,
        ]);

        return "https://test.stytch.com/v1/b2b/public/oauth/microsoft/discovery/start?" . $query;
    }
}
