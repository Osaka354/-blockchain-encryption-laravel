<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Text;

use App\Http\Controllers\EncrytionController;

class DesController extends EncrytionController
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
}
