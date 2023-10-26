<?php

namespace App\Rafinita\Curl;

use App\Rafinita\Requests\DTO\AbstractRequestDTO;

class RafinitaCurl extends BaseCurl
{

    protected function setRequest(AbstractRequestDTO $request): void
    {
        $this->setAllPost($request->serialize());
    }
}