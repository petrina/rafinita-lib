<?php

namespace App\Rafinita\Requests\DTO;

abstract class AbstractRequestDTO
{
    abstract function serialize(): array;
}