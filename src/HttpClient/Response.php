<?php

namespace LittleGreenMan\StytchPHP\HttpClient;

use LittleGreenMan\StytchPHP\Exceptions\InvalidOrganizationSlugException;
use LittleGreenMan\StytchPHP\HttpClient\Response\ErroneousResponses;
use Psr\Http\Message\ResponseInterface;

class Response
{
    protected string $body;
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->body = $response->getBody()->getContents();
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getBodyObject(): object|null
    {
        return json_decode($this->body);
    }

    /**
     * @throws InvalidOrganizationSlugException
     */
    public function getBodyOrThrowException(): object|array
    {
        if (!$this->isSuccessful()) {
            $exceptionClass = ErroneousResponses::findExceptionForErroneousResponse($this);
            $error = ErroneousResponses::createErrorMessage($this);
            throw new $exceptionClass($error);
        }

        return $this->getBodyObject();
    }

    public function isSuccessful()
    {
        return $this->response->getStatusCode() >= 200 && $this->response->getStatusCode() < 300;
    }
}
