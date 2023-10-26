<?php

namespace Lib\Rafinita\Curl;

use Lib\Rafinita\Requests\DTO\SaleRequestDTO;
use Lib\Rafinita\Response\Entity\ResponseEntity;
use Exception;

class SaleRafinitaCurl extends RafinitaCurl
{

    /**
     * @throws Exception
     */
    public function send(SaleRequestDTO $saleRequestDTO): ResponseEntity
    {
        $this->setRequest($saleRequestDTO);
        return $this->curl();
    }
}