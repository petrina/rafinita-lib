<?php

namespace Lib\Rafinita\Requests\DTO;

abstract class AbstractRequestDTO
{
    abstract function serialize(): array;
}