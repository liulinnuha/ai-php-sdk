<?php

namespace AiPhpSdk;

use AiPhpSdk\Support\ProviderFactory;
use AiPhpSdk\Contracts\AiProviderInterface;
use AiPhpSdk\Contracts\SupportsEmbeddingInterface;
use AiPhpSdk\Contracts\SupportsModerationInterface;
use AiPhpSdk\Exceptions\AiSdkException;

class Client
{
    protected AiProviderInterface $provider;

    /**
     * Create a new client instance.
     *
     * @param string $providerName
     * @param array $config
     */
    public function __construct(string $providerName, array $config)
    {
        $this->provider = ProviderFactory::make($providerName, $config);
    }

    /**
     * Chat with the AI provider.
     *
     * @param array $messages
     * @param array $options
     * @return mixed
     */
    public function chat(array $messages, array $options = []): mixed
    {
        return $this->provider->chat($messages, $options);
    }

    /**
     * Embed text into a vector.
     *
     * @param string $input
     * @return array
     */
    public function embed(string $input): array
    {
        if (!$this->provider instanceof SupportsEmbeddingInterface) {
            throw new AiSdkException(
                'This provider does not support embedding.',
            );
        }

        return $this->provider->embed($input);
    }

    /**
     * Moderate text.
     *
     * @param string $input
     * @return array
     */
    public function moderate(string $input): array
    {
        if (!$this->provider instanceof SupportsModerationInterface) {
            throw new AiSdkException(
                'This provider does not support moderation.',
            );
        }

        return $this->provider->moderate($input);
    }

    /**
     * Get the AI provider instance.
     *
     * @return AiProviderInterface
     */
    public function getProvider(): AiProviderInterface
    {
        return $this->provider;
    }
}
