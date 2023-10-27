<?php

namespace App\Rafinita\Helper;

class HashHelper
{

    static public function generate(string $email, string $cardNumber): string
    {
        return md5(
            strtoupper(
                strrev(
                    $email
                ) .
                '13a4822c5907ed235f3a068c76184fc3' .
                strrev(
                    substr($cardNumber, 0, 6) .
                    substr($cardNumber, -4)
                )
            )
        );
    }
}