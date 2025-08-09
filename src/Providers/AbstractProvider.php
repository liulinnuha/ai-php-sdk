<?php
namespace AiPhpSdk\Providers;

use GuzzleHttp\Client as HttpClient;
use AiPhpSdk\Support\OptionHelper;
use AiPhpSdk\Support\Traits\HasDefaultOptions;

abstract class AbstractProvider
{
    use HasDefaultOptions;

    protected string $apiKey;
    protected string $model;
    protected array $config;
    protected int $limitTokens;
    protected HttpClient $http;

    public function __construct(array $config)
    {
        $this->apiKey =
            $config['api_key'] ??
            throw new \InvalidArgumentException('api_key is required');
        $this->model =
            $config['model'] ??
            throw new \InvalidArgumentException('model is required');
        $this->limitTokens = $config['limit_tokens'] ?? 4096;
        $this->config = $config;
    }

    /**
     * Get the default options for the provider.
     *
     * @return array
     */
    protected function getDefaultOptions(): array
    {
        return [
            'model' => $this->model,
            'max_tokens' => 256,
            'temperature' => 0.7,
            'top_p' => 1.0,
            'frequency_penalty' => 0.0,
            'presence_penalty' => 0.0,
        ];
    }

    /**
     * Get the option rules for the provider.
     *
     * @return array
     */
    protected function getOptionRules(): array
    {
        return [
            'model' => 'string',
            'max_tokens' => 'integer',
            'temperature' => 'double',
            'top_p' => 'double',
            'frequency_penalty' => 'double',
            'presence_penalty' => 'double',
        ];
    }

    /**
     * Prepare the chat options for the provider.
     *
     * @param array $options
     * @return array
     */
    protected function prepareChatOptions(array $options): array
    {
        $merged = OptionHelper::mergeDefaultOptions(
            $options,
            $this->getDefaultOptions(),
        );
        OptionHelper::validate($merged, $this->getOptionRules());

        if ($merged['max_tokens'] > $this->limitTokens) {
            if (function_exists('logger')) {
                //for laravel
                logger()->warning(
                    "max_tokens ({$merged['max_tokens']}) melebihi limit ({$this->limitTokens}), akan dikurangi otomatis.",
                );
            } else {
                error_log(
                    "AiPhpSdk: max_tokens ({$merged['max_tokens']}) melebihi limit ({$this->limitTokens}), dikurangi otomatis.",
                );
            }

            $merged['max_tokens'] = $this->limitTokens;
        }

        return $merged;
    }
}
