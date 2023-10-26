<?php

namespace Lib\Rafinita\Response\Entity;

class ResponseBodyEntity
{

    private string $body;

    public function setResponseBody(string $body): void
    {
        $this->body = trim($body);
    }

    public function getBody(): string
    {
        return $this->body;
    }
}