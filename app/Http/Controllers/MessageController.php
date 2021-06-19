<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{

    public function create()
    {
        return view('message');
    }

    public function store(Request $request){
        // TODO: validate incoming params first!

        $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
        $params = ["to" => ["type" => "whatsapp", "number" => $request->input('number')],
            "from" => ["type" => "whatsapp", "number" => "14157386170"],
            "message" => [
                "content" => [
                    "type" => "text",
                    "text" => "Hello from Vonage and Laravel :) Please reply to this message with a number between 1 and 100"
                ]
            ]
        ];
        $headers = ["Authorization" => "Basic " . base64_encode('12025985'. ":" . '8mWYBKbcCT0zN0St')];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
        $data = $response->getBody();
        dd($data);

        return view('thanks');
    }

    public function status(Request $request){
        $data = $request->all();
        Log::Info($data);
    }

    public function inbound(Request $request){
        $data = $request->all();

        $text = $data['message']['content']['text'];
        $number = intval($text);
        Log::Info($number);
        if($number > 0) {
            $random = rand(1, 8);
            Log::Info($random);
            $respond_number = $number * $random;
            Log::Info($respond_number);
            $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
            $params = ["to" => ["type" => "whatsapp", "number" => $data['from']['number']],
                "from" => ["type" => "whatsapp", "number" => "573244718792"],
                "message" => [
                    "content" => [
                        "type" => "text",
                        "text" => "The answer is " . $respond_number . ", we multiplied by " . $random . "."
                    ]
                ]
            ];
            $headers = ["Authorization" => "Basic " . base64_encode('12025985'. ":" . '8mWYBKbcCT0zN0St')];

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
            $data = $response->getBody();
        }
        Log::Info($data);
    }
}
