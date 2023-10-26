<?php

namespace Lib\Rafinita\Curl;

use Lib\Rafinita\Response\Entity\ResponseBodyEntity;
use Lib\Rafinita\Response\Entity\ResponseEntity;
use Lib\Rafinita\Response\Entity\ResponseHeaderEntity;
use Exception;

class BaseCurl
{
    const RAFINITA_URL = 'https://dev-api.rafinita.com/post';

    private array $postData = [];

    protected function getAllPost(): array
    {
        return $this->postData;
    }

    protected function setAllPost(array $post): BaseCurl
    {
        $this->postData = $post;
        return $this;
    }

    protected function getPost(string $name): mixed
    {
        return $this->postData[$name] ?? null;
    }

    protected function setPost(string $name, mixed $value): BaseCurl
    {
        $this->postData[$name] = $value;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function curl(?array $post = null): ResponseEntity
    {
        if ($post !== null) {
            $this->postData = $post;
        }

        $curl = curl_init();
        if ($curl === false) {
            throw new Exception('curl not found');
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => self::RAFINITA_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $this->clearRequest(),
            CURLOPT_HEADER => true,
//            CURLOPT_HTTPHEADER => [],
        ]);

        $result = curl_exec($curl);
        if ($result === false) {
            throw new Exception(curl_error($curl));
        }

        curl_close($curl);

        $response = explode("\r\n\r\n", $result);

        $headerEntity = new ResponseHeaderEntity();
        $headerEntity->setResponseHeaders(reset($response));

        $bodyEntity = new ResponseBodyEntity();
        $bodyEntity->setResponseBody(end($response));

        $responseEntity = new ResponseEntity();
        $responseEntity->setResponse($headerEntity, $bodyEntity);

        return $responseEntity;
    }

    private function clearRequest(): array
    {
        $clearArray = [];
        foreach ($this->postData as $key => $value) {
            if ($value !== null) {
                $clearArray[$key] = $value;
            }
        }
        return $clearArray;
    }
}