<?php

namespace AiPhpSdk\Support\Traits;
use AiPhpSdk\Support\OptionHelper;

trait HasDefaultOptions
{
    protected function getDefaultOptions(): array
    {
        return [
            'model' => $this->model ?? null,
            'max_tokens' => 256,
            'temperature' => 0.7,
            'top_p' => 1,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ];
    }

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

    protected function prepareOptions(array $options): array
    {
        $merged = OptionHelper::mergeDefaultOptions(
            $options,
            $this->getDefaultOptions(),
        );
        OptionHelper::validate($merged, $this->getOptionRules());

        if (
            isset($this->limitTokens) &&
            isset($merged['max_tokens']) &&
            $merged['max_tokens'] > $this->limitTokens
        ) {
            trigger_error(
                "max_tokens ({$merged['max_tokens']}) melebihi batas limitTokens ({$this->limitTokens})",
                E_USER_WARNING,
            );
        }

        return $merged;
    }
}
