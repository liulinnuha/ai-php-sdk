<?php

namespace AiPhpSdk\Providers;

use GuzzleHttp\Client as HttpClient;
use AiPhpSdk\Contracts\AiProviderInterface;

class DeepSeekProvider extends AbstractProvider implements AiProviderInterface
{
    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->http = new HttpClient([
            'base_uri' => $config['base_uri'] ?? 'https://api.deepseek.com/v1/',
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Chat with DeepSeek's chat API.
     *
     * @param array $messages The messages to chat with.
     * @param array $options The options for the chat.
     * @return array The chat result.
     */
    public function chat(array $messages, array $options = []): array
    {
        $options = $this->prepareChatOptions($options);

        $payloads = array_merge($options, [
            'messages' => $messages,
        ]);

        $res = $this->http->post('chat/completions', [
            'json' => $payloads,
        ]);

        $body = json_decode($res->getBody()->getContents(), true);

        return $body;
    }

    /**
     * Get the balance of DeepSeek's account.
     *
     * @return array The balance result.
     */
    public function getBalance(): array
    {
        $res = $this->http->get('user/balance');

        $body = json_decode($res->getBody()->getContents(), true);

        return $body;
    }
    // public function embed(string $input): array
    // {
    //     return ['vector' => [0.1, 0.2, 0.3]];
    // }

    // public function moderate(string $input): array
    // {
    //     return ['flagged' => false];
    // }
}
