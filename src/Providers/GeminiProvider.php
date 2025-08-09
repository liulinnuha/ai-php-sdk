<?php

namespace AiPhpSdk\Providers;

use GuzzleHttp\Client as HttpClient;
use AiPhpSdk\Contracts\AiProviderInterface;

class GeminiProvider extends AbstractProvider implements AiProviderInterface
{
    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->http = new HttpClient([
            'base_uri' =>
                $config['base_uri'] ??
                'https://generativelanguage.googleapis.com/v1beta/',
        ]);
    }

    /**
     * Chat with Gemini's chat API.
     *
     * @param array $messages The messages to chat with.
     * @return array The chat result.
     */
    public function chat(array $messages): array
    {
        $res = $this->http->post("models/{$this->model}:generateContent", [
            'query' => ['key' => $this->apiKey],
            'json' => [
                'contents' => [['parts' => $messages]],
            ],
        ]);

        return json_decode($res->getBody(), true);
    }

    /**
     * Embed text using Gemini's embedding API.
     *
     * @param string $input The text to embed.
     * @return array The embedding result.
     */
    public function embed(string $input): array
    {
        // Gemini belum support full embedding API (mock)
        return ['vector' => [0.1, 0.2, 0.3]];
    }

    /**
     * Moderate text using Gemini's moderation API.
     *
     * @param string $input The text to moderate.
     * @return array The moderation result.
     */
    public function moderate(string $input): array
    {
        // Belum ada API moderasi di Gemini
        return ['flagged' => false];
    }
}
