<?php

namespace Lib\Rafinita\Curl;

use Lib\Rafinita\Requests\DTO\AbstractRequestDTO;

class RafinitaCurl extends BaseCurl
{

    protected function setRequest(AbstractRequestDTO $request): void
    {
        $this->setAllPost($request->serialize());
    }
}