<?php

namespace Fibdesign\Bale;

class BaleService
{
    private string $apiKey;
    private string $chat;
    private string $url;
    private string $endpoint;
    private string $message;

    public function __construct()
    {
        $this->apiKey = config('bale.apiKey');
        $this->chat = config('bale.chat');
        $this->url = config('bale.url');
        $this->endpoint = config('bale.endpoint');
    }

    public function message(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function chat(string $id): self
    {
        $this->chat = $id;
        return $this;
    }

    public function dispatch():string
    {
        $postUrl = $this->url.$this->apiKey.$this->endpoint;
        $postFields = [
            'chat_id' => $this->chat,
            'text' => $this->message
        ];
        $curl = curl_init();
        curl_setopt_array($curl,
            array(
                CURLOPT_URL => $postUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postFields
            ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return 'error:'.$err;
        }
        return $response;
    }
}
