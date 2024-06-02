<?php

namespace LittleGreenMan\StytchPHP\HttpClient;

use Brick\JsonMapper\JsonMapper;
use Brick\JsonMapper\OnMissingProperties;
use LittleGreenMan\StytchPHP\Exceptions\InvalidOrganizationIdException;
use LittleGreenMan\StytchPHP\Exceptions\InvalidOrganizationSlugException;
use LittleGreenMan\StytchPHP\Exceptions\OrganizationNotFoundException;
use LittleGreenMan\StytchPHP\Exceptions\OrganizationSlugAlreadyUsedException;
use Psr\Http\Message\ResponseInterface;

class StytchResponseHandler
{
    protected string $body;
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->body = $response->getBody()->getContents();
    }

    public static function hydrateClass(string $className, ResponseInterface $from): mixed
    {
        return (new self($from))->hydrate($className);
    }

    public function hydrate(string $className): mixed
    {
        $mapper = new JsonMapper(
            allowUntypedObjects: true,
            onMissingProperties: OnMissingProperties::SET_NULL
        );
        return $mapper->map($this->body, $className);
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getResponseBodyAsObject(): object|null
    {
        return json_decode($this->body);
    }

    public function getResponseBodyAsArray(): array
    {
        return json_decode($this->body, associative: true);
    }

    /**
     * @throws InvalidOrganizationSlugException
     */
//    public function getBodyOrFail(): object|array
//    {
//        if (!$this->isSuccessful()) {
//            $this->throwFailingResponseException();
//        }
//
//        return $this->getResponseBodyAsObject();
//    }

    public function status(): int
    {
        return $this->response->getStatusCode();
    }

    public function isSuccessful(): bool
    {
        return $this->status() >= 200 && $this->status() < 300;
    }

    private function throwFailingResponseException()
    {
        $exceptionClass = self::findExceptionForErroneousResponse($this);
        $error = self::createErrorMessage($this);
        throw new $exceptionClass($error);
    }

    private static function findExceptionForErroneousResponse(StytchResponseHandler $response): string
    {
        return match ($response->getResponseBodyAsObject()?->error_type) {
            'organization_slug_already_used' => OrganizationSlugAlreadyUsedException::class,
            'invalid_organization_id' => InvalidOrganizationIdException::class,
            'organization_not_found' => OrganizationNotFoundException::class,
            'invalid_organization_slug' => InvalidOrganizationSlugException::class,
            default => \Exception::class
        };
    }

    private static function createErrorMessage(StytchResponseHandler $response): string
    {
        $responseObject = $response->getResponseBodyAsObject();

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
