<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Testing\TestResponse;

class HailTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // https://github.com/laravel/framework/issues/18016#issuecomment-322401713
        $test = $this;

        TestResponse::macro('followRedirects', function ($testCase = null) use ($test) {
            $response = $this;
            $testCase = $testCase ?: $test;

            while ($response->isRedirect()) {
                $response = $testCase->get($response->headers->get('Location'));
            }

            return $response;
        });
    }
    public function test_home()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_auth()
    {
        $response = $this->get('/auth');
        $url = $response->headers->get('Location');
        $uri = parse_url($url);
        parse_str($uri['query'], $query);

        $this->assertArrayHasKey('client_id', $query);
        $this->assertArrayHasKey('redirect_uri', $query);
        $this->assertArrayHasKey('state', $query);
        $this->assertArrayHasKey('scope', $query);
        $this->assertArrayHasKey('response_type', $query);
        $this->assertArrayHasKey('approval_prompt', $query);
    }

    public function test_logout()
    {
        $response = $this->get('/logout')
            ->assertRedirect('/')
            ->followRedirects()
            ->assertSee('Login');
    }
}
