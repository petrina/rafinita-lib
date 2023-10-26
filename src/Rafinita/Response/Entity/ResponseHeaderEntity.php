<?php

namespace Lib\Rafinita\Response\Entity;

class ResponseHeaderEntity
{
    private int $status = 200;
    private array $headers;

    public function setResponseHeaders(string $headers): void
    {
        $headers = explode("\n", $headers);
        foreach ($headers as $key => $value) {
            if ($key === 0) {
                preg_match('/http.* ([0-9]{3})/is', $value, $match);
                $this->status = end($match);
            } else {
                $rowArray = explode(':', $value);
                $headerName = trim(reset($rowArray));
                $headerValue = trim(end($rowArray));
                $this->headers[$headerName] = $headerValue;
            }
        }
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }
}