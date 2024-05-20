<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Response;

use LittleGreenMan\StytchPHP\Exceptions\InvalidOrganizationIdException;
use LittleGreenMan\StytchPHP\Exceptions\InvalidOrganizationSlugException;
use LittleGreenMan\StytchPHP\Exceptions\OrganizationNotFoundException;
use LittleGreenMan\StytchPHP\Exceptions\OrganizationSlugAlreadyUsedException;
use LittleGreenMan\StytchPHP\HttpClient\Response;

class ErroneousResponses
{
    public static function findExceptionForErroneousResponse(Response $response): string
    {
        return match ($response->getBodyObject()?->error_type) {
            'organization_slug_already_used' => OrganizationSlugAlreadyUsedException::class,
            'invalid_organization_id' => InvalidOrganizationIdException::class,
            'organization_not_found' => OrganizationNotFoundException::class,
            'invalid_organization_slug' => InvalidOrganizationSlugException::class,
            default => \Exception::class
        };
    }

    public static function createErrorMessage(Response $response): string
    {
        $responseObject = $response->getBodyObject();

        if (isset($responseObject->error_type)
            && isset($responseObject->error_message)
            && isset($responseObject->request_id)
            && isset($responseObject->error_url)
        ) {
            return $responseObject->error_message . "('" . $responseObject->error_type . "' for request '" . $responseObject->request_id . "'). More info: " . $responseObject->error_url;
        } else {
            return "A StytchPHP error occurred: " . $response->getResponse()->getReasonPhrase();
        }
    }
}

//{
//"status_code":400,
//"request_id":"request-id-test-ed75082c-ac1d-4cdb-83d8-b226bfd92f92",
//"error_type":"organization_slug_already_used",
//"error_message":"The provided organization_slug is already used in another organization.",
//"error_url":"https://stytch.com/docs/b2b/api/errors/400#organization_slug_already_used"
//}
