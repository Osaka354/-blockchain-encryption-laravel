<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class RsaController extends Controller
{
    public function encrypt(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $data = $request['content'];
        $pubKey = $this->get_public_key();

        openssl_public_encrypt($data, $encrypted, $pubKey);

        $base64encoded = base64_encode($encrypted);

        return response($base64encoded);
    }

    public function decrypt(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $cipher = $request['content'];
        $cipher = base64_decode($cipher);
        
        $private_key = $this-> get_private_key();

        openssl_private_decrypt($cipher, $plaint_text, $private_key);
        return $plaint_text;
    }

    public function get_public_key()
    {
        if (Storage::exists('key\private.pem') && Storage::exists('key\public.pem')) {
            $pubKey = Storage::get('key\public.pem');
            return $pubKey;
        } else {
            return $this->gen_key();
        }
    }

    private function get_private_key()
    {
        if (Storage::exists('key\private.pem') && Storage::exists('key\public.pem')) {
            $private = Storage::get('key\private.pem');
            return $private;
        } else {
            $this->gen_key();
            return $this->get_private_key();
        }
    }

    private function gen_key()
    {
        $config = array(
            "digest_alg" => "sha256",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );
        
        $res = openssl_pkey_new($config);

        openssl_pkey_export($res, $privKey);

        $pubKey = openssl_pkey_get_details($res);
        $pubKey = $pubKey["key"];

        Storage::put('key\private.pem', $privKey);
        Storage::put('key\public.pem', $pubKey);

        return $pubKey;
    }
}
