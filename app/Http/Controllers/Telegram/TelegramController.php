<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramController extends Controller
{
    //
    protected $token = "5409689822:AAGNeNsImZCV6NTgRGp2ULXzcz1zPzDjAB4";
    protected $baseUrl = "https://telegram.shixeh.com/telegram";
    // https://api.telegram.org/bot5409689822:AAGNeNsImZCV6NTgRGp2ULXzcz1zPzDjAB4/getUpdates
    // https://api.telegram.org/bot5409689822:AAGNeNsImZCV6NTgRGp2ULXzcz1zPzDjAB4/deleteWebHook?url=
    // https://api.telegram.org/bot5409689822:AAGNeNsImZCV6NTgRGp2ULXzcz1zPzDjAB4/sendMessage?chat_id=&amp;text=json
    // https://api.telegram.org/bot5409689822:AAGNeNsImZCV6NTgRGp2ULXzcz1zPzDjAB4/setWebHook?url=https://telegram.shixeh.com/telegram.php
    // https://api.telegram.org/bot5409689822:AAGNeNsImZCV6NTgRGp2ULXzcz1zPzDjAB4/getWebHookInfo?url=https://tel.freecluster.eu/teleg.php
    
    // https://panel.servermax.net/clientarea.php?action=productdetails&id=1541
    //T^5%OLj,HMWy

    public function __conctract()
    {
        # code...
    }

    public function index(Request $request)
    {
        # code...
        ini_set("allow_url_fopen", "1");
        $json = file_get_contents("php://input");
        $update = json_decode($json, true);

        $group_id = -672687753;
        $chanel_id = -1001697519941;
        $bot_id = 926406689;

        $message = $update['message']['text'] ?? 'NOT';
        $chat_id = $update['message']['chat']['id'] ?? $bot_id; //5409689822//-672687753 // // -1697519941
        // return 'ok';
        // $rep = json_decode(
        //     file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$json")
        // );

        $this->sendMessage($chat_id, $json);
        $this->sendMessage($group_id, $message);
        $this->sendMessage($bot_id, $message);
        $this->sendMessage($chanel_id, $message);

        // file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$json");



        // file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$group_id&text=$message");

        //file_get_contents("https://api.telegram.org/bot5409689822:AAGNeNsImZCV6NTgRGp2ULXzcz1zPzDjAB4/sendMessage?chat_id=-1697519941&text=1");
        //file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$bot_id&text=$message");
        //file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chanel_id&text=$message");
    }

    public function setWebHook()
    {
        $res = Http::get("https://api.telegram.org/bot$this->token/setWebHook?url=$this->baseUrl");
        return $res->json();
    }

    public function deleteWebHook()
    {
        $res = Http::get("https://api.telegram.org/bot$this->token/deleteWebHook?url=$this->baseUrl");
        return $res->json();
    }
    
    public function getWebHookInfo()
    {
        $res = Http::get("https://api.telegram.org/bot$this->token/getWebHookInfo?url=$this->baseUrl");
        return $res->json();
    }

    public function sendMessage($chatId, $text)
    {
        $res = Http::get("https://api.telegram.org/bot$this->token/sendMessage?chat_id=$chatId&text=$text");
        return $res->json();
    }
}
