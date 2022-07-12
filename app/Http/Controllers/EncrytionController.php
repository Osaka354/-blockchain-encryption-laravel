<?php

namespace App\Http\Controllers;

class EncrytionController extends Controller
{
    private function get_key()
    {
        // $key = base64_encode("21312345FFDCE3432521FDCD");
        $key = "21FAC121";
        return $key;
    }

    public function encrypt($plain_text)
    {
        $cipher = openssl_encrypt($plain_text, "DES-ECB", $this->get_key());
        // $cipher_bash64 = base64_encode($cipher);
        return $cipher;
    }

    public function decrypt($cipher)
    {
        // $cipher_bash64 = '';
        // $cipher_bash64 = base64_decode($cipher);
        $plain_text = openssl_decrypt($cipher, "DES-ECB", $this->get_key());
        return $plain_text;
    }
}
