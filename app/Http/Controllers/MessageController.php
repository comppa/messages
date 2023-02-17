<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\Log;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Id;

class MessageController extends Controller
{

    public function create()
    {
        return view('message');
    }

    public function link()
    {
        return view('link');
    }

    public function image()
    {
        return view('image');
    }


    public function store(Request $request){
        // TODO: validate incoming params firstt

            //Consultado los ids
            $users = Id::all()->random(300);
            foreach ($users as $value){
                $wb_token = TOKEN;
                $wb_from = SEND_NUMBER;
                $id = uniqid($prefix = "HL");
                $in_number = '57'.$value->number;
                $name = explode(' ', $value->name)[0];
                $in_text = 'Hola 💙💙, ' . $name. ' ' . $request->get('msg');
                $client = new GuzzleHttp\Client();
                $url = 'https://www.waboxapp.com/api/send/chat';

                $compose_url = '?token='. $wb_token .'&uid=' . $wb_from . '&to=' . $in_number . '&custom_uid=' . $id . '&text=' . $in_text;

                $options['timeout'] = 300;
                $response = $client->request('POST', $url . $compose_url);
                $data = $response->getStatusCode();
                $value->status = $data;
                $value->save(); 
                sleep(0.2);
            }

            return view('message');

            /* $wb_token = TOKEN;
                $wb_from = SEND_NUMBER;
            $id = uniqid($prefix = "HL");
            $in_text = 'Hola ' . 'Juan+ Fernando Moreno' . $request->get('msg');
            $client = new GuzzleHttp\Client();
            $url = 'https://www.waboxapp.com/api/send/chat';

            $compose_url = '?token='. $wb_token .'&uid=' . $wb_from . '&to=' . $in_number . '&custom_uid=' . $id . '&text=' . $in_text;

            $response = $client->request('GET', $url . $compose_url);
            $data = $response->getStatusCode();
            
            dd($data);
            */
    }

    public function send_image(Request $request){
        // TODO: validate incoming params firstt

            //Consultado los ids
            $users = Id::all()->take(1);
            foreach ($users as $value){
                $wb_token = TOKEN;
                $wb_from = SEND_NUMBER;
                $id = uniqid($prefix = "HL");
                $in_number = '57'.$value->number;
                $name = explode(' ', $value->name)[0];
               /*  $url_meta = '$request->get('url')'; */
                $url_meta = 'https://demo.twilio.com/owl.png';

                /* $title = $request->get('title');
                 */
/*                 $url_thumb = $request->get('url_thumb');
 */             $client = new GuzzleHttp\Client();  
                $url = 'https://www.waboxapp.com/api/send/image';

                $title = 'Te invitamos ' . $name. ' '. $request->get('title');
                $compose_url = '?token='. $wb_token .'&uid=' . $wb_from . '&to=' . $in_number . '&custom_uid=' . $id . '&url=' . $url_meta. '&caption=' . $title ;

                $options['timeout'] = 300;
                $response = $client->request('POST', $url . $compose_url);
                $data = $response->getStatusCode();
                $value->status = $data;
                $value->save(); 
                sleep(0.2);
            }

            return view('image');

            /* $wb_token = TOKEN;
                $wb_from = SEND_NUMBER;
            $id = uniqid($prefix = "HL");
            $in_text = 'Hola ' . 'Juan Fernando Moreno' . $request->get('msg');
            $client = new GuzzleHttp\Client();
            $url = 'https://www.waboxapp.com/api/send/chat';

            $compose_url = '?token='. $wb_token .'&uid=' . $wb_from . '&to=' . $in_number . '&custom_uid=' . $id . '&text=' . $in_text;

            $response = $client->request('GET', $url . $compose_url);
            $data = $response->getStatusCode();
            
            dd($data);
            */
    }


    public function send_link(Request $request){
        // TODO: validate incoming params firstt

            //Consultado los ids
            $users = Id::all()->take(1);
            foreach ($users as $value){
                $wb_token = TOKEN;
                $wb_from = SEND_NUMBER;
                $id = uniqid($prefix = "HL");
                $in_number = '57'.$value->number;
                $name = explode(' ', $value->name)[0];
                $url_meta = $request->get('url');
                $title = $request->get('title');
                $description = 'Hola ' . $name. ' '. $request->get('description');
                $url_thumb = $request->get('url_thumb');
                $client = new GuzzleHttp\Client();
                $url = 'https://www.waboxapp.com/api/send/link';

                $compose_url = '?token='. $wb_token .'&uid=' . $wb_from . '&to=' . $in_number . '&custom_uid=' . $id . '&url=' . $url_meta . '&caption='. $title . 
                '&description=' . $description . '&url_thumb=' . $url_thumb;

                $response = $client->request('GET', $url . $compose_url);
                $data = $response->getStatusCode();
                $value->status = $data;
                $value->save();
                sleep(2);
            }

            return view('link');

            /* $wb_token = TOKEN;
                $wb_from = SEND_NUMBER;
            $id = uniqid($prefix = "HL");
            $in_number = '573146223694';
            $in_text = 'Hola ' . 'Juan Fernando Moreno' . $request->get('msg');
            $client = new GuzzleHttp\Client();
            $url = 'https://www.waboxapp.com/api/send/chat';

            $compose_url = '?token='. $wb_token .'&uid=' . $wb_from . '&to=' . $in_number . '&custom_uid=' . $id . '&text=' . $in_text;

            $response = $client->request('GET', $url . $compose_url);
            $data = $response->getStatusCode();
            
            dd($data);
            */
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
                "from" => ["type" => "whatsapp", "number" => SEND_NUMBER],
                "message" => [
                    "content" => [
                        "type" => "text",
                        "text" => "The answer is " . $respond_number . ", we multiplied by " . $random . "."
                    ]
                ]
            ];
            $headers = ["Authorization" => "Basic " . base64_encode(''. ":" . '')];

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
            $data = $response->getBody();
        }
        Log::Info($data);
    }
}
