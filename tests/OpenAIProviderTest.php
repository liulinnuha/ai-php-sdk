<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use AiPhpSdk\Providers\OpenAIProvider;

class OpenAIProviderTest extends TestCase
{
    public function testChatReturnsResponse()
    {
        $mock = new MockHandler([
            new Response(
                200,
                [],
                json_encode([
                    'choices' => [
                        [
                            'message' => [
                                'role' => 'assistant',
                                'content' => 'Hello!',
                            ],
                        ],
                    ],
                ]),
            ),
        ]);

        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $provider = new OpenAIProvider([
            'api_key' => 'test-key',
            'model' => 'gpt-3.5-turbo',
            'base_uri' => '',
        ]);

        $reflection = new ReflectionClass($provider);
        $property = $reflection->getProperty('http');
        $property->setAccessible(true);
        $property->setValue($provider, $client);

        $result = $provider->chat([['role' => 'user', 'content' => 'Hi!']]);

        $this->assertArrayHasKey('choices', $result);
    }
}
