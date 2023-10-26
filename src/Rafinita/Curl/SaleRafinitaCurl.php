<?php

namespace App\Rafinita\Curl;

use App\Rafinita\Requests\DTO\SaleRequestDTO;
use App\Rafinita\Response\Entity\ResponseEntity;
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