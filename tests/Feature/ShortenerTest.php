<?php

namespace Tests\Feature;

use Tests\TestCase;

class ShortenerTest extends TestCase
{
    public function test_the_application_shortens_a_url(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer []{}'
        ])->post('/api/v1/short-urls', [
            'url' => 'https://www.example.com/my-really-long-link-that-I-need-to-shorten/84378949'
        ]);

        // Don't assert the status because it can be 200 or 304
        $response->assertJson([
            'url' => 'https://tinyurl.com/y4j6gh6w',
        ]);
    }

    public function test_the_authentication_fails(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer lololo'
        ])->post('/api/v1/short-urls', [
            'url' => 'https://www.example.com/my-really-long-link-that-I-need-to-shorten/84378949'
        ]);

        $response->assertStatus(401);
    }
}
