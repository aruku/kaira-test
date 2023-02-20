<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TinyUrlShortener
{
    public function requestShortUrl(string $urlToShorten): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return Http::withHeaders([
            'accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get("https://tinyurl.com/api-create.php?url=$urlToShorten");
    }
}
