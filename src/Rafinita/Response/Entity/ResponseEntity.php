<?php

namespace Lib\Rafinita\Response\Entity;

class ResponseEntity
{

    private ResponseHeaderEntity $headerEntity;
    private ResponseBodyEntity $bodyEntity;

    public function setResponse(ResponseHeaderEntity $headerEntity, ResponseBodyEntity $bodyEntity): void
    {
        $this->headerEntity = $headerEntity;
        $this->bodyEntity = $bodyEntity;
    }

    public function getStatus(): int
    {
        return $this->headerEntity->getStatus();
    }

    public function getHeaders(): array
    {
        return $this->headerEntity->getHeaders();
    }

    public function getBody(): string
    {
        return $this->bodyEntity->getBody();
    }

    public function getJson(): mixed
    {
        return json_decode($this->getBody());
    }
}