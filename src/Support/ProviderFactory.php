<?php

namespace AiPhpSdk\Support;

use AiPhpSdk\Constants\ProviderName;
use AiPhpSdk\Contracts\AiProviderInterface;
use AiPhpSdk\Providers\OpenAIProvider;
use AiPhpSdk\Providers\GeminiProvider;
use AiPhpSdk\Providers\DeepSeekProvider;
use AiPhpSdk\Exceptions\AiSdkException;

class ProviderFactory
{
    public static function make(
        string $providerName,
        array $config,
    ): AiProviderInterface {
        $provider = match (strtolower($providerName)) {
            ProviderName::OPENAI => new OpenAIProvider($config),
            ProviderName::GEMINI => new GeminiProvider($config),
            ProviderName::DEEPSEEK => new DeepSeekProvider($config),
            default => throw new AiSdkException(
                "Provider '{$providerName}' is not supported.",
            ),
        };

        if (!$provider instanceof AiProviderInterface) {
            throw new AiSdkException(
                "Invalid provider implementation for $providerName",
            );
        }

        return $provider;
    }
}
