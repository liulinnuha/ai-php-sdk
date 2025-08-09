<?php
namespace AiPhpSdk\Support;

use AiPhpSdk\Exceptions\AiSdkException;

class OptionHelper
{
    public static function mergeDefaultOptions(
        array $options,
        array $defaults,
    ): array {
        return array_merge($defaults, $options);
    }

    public static function validate(array $options, array $rules): void
    {
        foreach ($rules as $key => $type) {
            if (!array_key_exists($key, $options)) {
                throw new AiSdkException("Option '{$key}' is required.");
            }

            if (gettype($options[$key]) !== $type) {
                throw new AiSdkException(
                    "Option '{$key}' must be of type {$type}.",
                );
            }
        }
    }
}
