<?php

namespace Lib\Rafinita\Helper;

class HashHelper
{

    static public function generate(string $email, string $cardNumber): string
    {
        return md5(
            strtoupper(
                strrev(
                    $email
                ) .
                'd0ec0beca8a3c30652746925d5380cf3' .
                strrev(
                    substr($cardNumber, 0, 6) .
                    substr($cardNumber, -4)
                )
            )
        );
    }
}