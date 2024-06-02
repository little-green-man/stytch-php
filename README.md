# Stytch PHP Library

The Stytch PHP library makes it easy to use the Stytch user infrastructure API in server-side PHP applications.

This library is compatible with PHP 8.0+

## Install

```bash
composer require little-green-man/stytch-php
```

## Usage

You can find your API credentials in the [Stytch Dashboard](https://stytch.com/dashboard/api-keys).

This client library supports all of Stytch's live products as follows:

> Note: This library is in development. The features below are being built out incrementally, and the SDK may have breaking changes until a stable release.

**B2C**

- [ ] [Email Magic Links](https://stytch.com/docs/api/send-by-email)
- [ ] [Embeddable Magic Links](https://stytch.com/docs/api/create-magic-link)
- [ ] [OAuth logins](https://stytch.com/docs/api/oauth-google-start)
- [ ] [SMS passcodes](https://stytch.com/docs/api/send-otp-by-sms)
- [ ] [WhatsApp passcodes](https://stytch.com/docs/api/whatsapp-send)
- [ ] [Email passcodes](https://stytch.com/docs/api/send-otp-by-email)
- [ ] [Session Management](https://stytch.com/docs/api/session-auth)
- [ ] [WebAuthn](https://stytch.com/docs/api/webauthn-register-start)
- [ ] [User Management](https://stytch.com/docs/api/create-user)
- [ ] [Time-based one-time passcodes (TOTPs)](https://stytch.com/docs/api/totp-create)
- [ ] [Crypto wallets](https://stytch.com/docs/api/crypto-wallet-authenticate-start)
- [ ] [Passwords](https://stytch.com/docs/api/password-create)

**B2B**

- [x] [Organizations](https://stytch.com/docs/b2b/api/organization-object)
- [x] [Members](https://stytch.com/docs/b2b/api/member-object)
- [ ] [RBAC](https://stytch.com/docs/b2b/api/rbac-resource-object)
- [ ] [Email Magic Links](https://stytch.com/docs/b2b/api/send-login-signup-email)
- [ ] [OAuth logins](https://stytch.com/docs/b2b/api/oauth-google-start)
- [ ] [Session Management](https://stytch.com/docs/b2b/api/session-object)
- [ ] [Single-Sign On](https://stytch.com/docs/b2b/api/sso-authenticate-start)
- [ ] [Discovery](https://stytch.com/docs/b2b/api/discovered-organization-object)
- [ ] [Passwords](https://stytch.com/docs/b2b/api/passwords-authenticate)
- [ ] [SMS OTP (MFA)](https://stytch.com/docs/b2b/api/otp-sms-send)
- [ ] [M2M](https://stytch.com/docs/b2b/api/m2m-client)

**Shared**

- [ ] [M2M](https://stytch.com/docs/api/m2m-client)

### Example B2C usage

TBD.

### Example B2B usage

Create an API client:

```php
$stytch = new StytchB2B(
    new ClientBuilder(
        secret: 'secret-test-...',
        project: 'project-test-...',
        publicToken: 'public-token-test-...',
        authUri: '/authentication',
        testMode: true
    )
);
```

Create an organization

```php
$stytch->organizations()->create('Test Organization', 'test-org')
```

Log the first user into the organization

```javascript
client.magicLinks
  .loginOrSignup({
    organization_id: "organization-id-from-create-response-...",
    email_address: "admin@acme.co",
  })
  .then((res) => console.log(res))
  .catch((err) => console.error(err));
```

## Handling Errors

TBD.

Learn more about errors in the [docs](https://stytch.com/docs/api/errors).

## Customizing the HTTPS Client

The Stytch client uses PSR 18 Client Discovery to find the first client that implements Psr\Http\Client\ClientInterface. It does this to avoid multiple or conflicting clients being installed in your app.

If you don't have one in the project, just require one (like Guzzle).

If you want to use a specific client, you can pass it to the Stytch ClientBuilder (see Install above).


## Documentation

See example requests and responses for all the endpoints in the [Stytch API Reference](https://stytch.com/docs/api).

Follow one of the [integration guides](https://stytch.com/docs/guides) or start with one of our [example apps](https://stytch.com/docs/example-apps).
