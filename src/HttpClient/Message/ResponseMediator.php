<?php

namespace LittleGreenMan\StytchPHP\HttpClient\Message;

use Psr\Http\Message\ResponseInterface;

class ResponseMediator
{
    public static function getContent(ResponseInterface $response): array|object
    {
        return json_decode($response->getBody()->getContents());
    }
}
