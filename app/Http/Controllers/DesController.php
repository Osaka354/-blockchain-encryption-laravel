<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Text;

class DesController extends Controller
{
    public function index()
    {
        $texts = Text::all();

        $data = ["data" => $texts];
        $json = json_encode($data);
        $encrypted = $this->encrypt($json);

        return response($encrypted, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            "content" => "required",
        ]);

        $content = $request->content;
        $decrypted = $this->decrypt($content);

        $text = new Text();
        $text->content = $decrypted;
        $text->save();

        $data = ["data" => $text];
        $json = json_encode($data);
        $encrypted = $this->encrypt($json);

        return response($encrypted, 200);
    }

    public function get_encrypyt(Request $request)
    {
        $request->validate([
            "content" => "required",
        ]);

        return $this->encrypt($request->content);
    }

    public function get_decrypyt(Request $request)
    {
        $request->validate([
            "content" => "required",
        ]);

        return $this->decrypt($request->content);
    }

    private function get_key()
    {
        // $key = base64_encode("21312345FFDCE3432521FDCD");
        $key = "21FAC121";
        return $key;
    }

    private function encrypt($plain_text)
    {
        $cipher = openssl_encrypt($plain_text, "DES-ECB", $this->get_key());
        // $cipher_bash64 = base64_encode($cipher);
        return $cipher;
    }

    private function decrypt($cipher)
    {
        // $cipher_bash64 = '';
        // $cipher_bash64 = base64_decode($cipher);
        $plain_text = openssl_decrypt($cipher, "DES-ECB", $this->get_key());
        return $plain_text;
    }
}
