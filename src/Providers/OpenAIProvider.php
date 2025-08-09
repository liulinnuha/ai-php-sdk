<?php

namespace AiPhpSdk\Providers;

use GuzzleHttp\Client as HttpClient;
use AiPhpSdk\Contracts\AiProviderInterface;
use AiPhpSdk\Contracts\SupportsModerationInterface;
use AiPhpSdk\Contracts\SupportsEmbeddingInterface;

class OpenAIProvider extends AbstractProvider implements
    AiProviderInterface,
    SupportsEmbeddingInterface,
    SupportsModerationInterface
{
    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->http = new HttpClient([
            'base_uri' => $config['base_uri'] ?? 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Chat with OpenAI's chat API.
     *
     * @param array $messages The messages to chat with.
     * @return array The chat result.
     */
    public function chat(array $messages): array
    {
        $res = $this->http->post('chat/completions', [
            'json' => [
                'model' => $this->model,
                'messages' => $messages,
            ],
        ]);

        return json_decode($res->getBody(), true);
    }

    /**
     * Embed text using OpenAI's embedding API.
     *
     * @param string $input The text to embed.
     * @return array The embedding result.
     */
    public function embed(string $input): array
    {
        $res = $this->http->post('embeddings', [
            'json' => [
                'model' => $this->model,
                'input' => $input,
            ],
        ]);

        return json_decode($res->getBody(), true);
    }

    /**
     * Moderate text using OpenAI's moderation API.
     *
     * @param string $input The text to moderate.
     * @return array The moderation result.
     */
    public function moderate(string $input): array
    {
        $res = $this->http->post('moderations', [
            'json' => ['input' => $input],
        ]);

        return json_decode($res->getBody(), true);
    }
}
