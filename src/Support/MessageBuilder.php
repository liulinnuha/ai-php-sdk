<?php

namespace AiPhpSdk\Support;

use AiPhpSdk\Constants\MessageRole;

class MessageBuilder
{
    public static function user(string $content): array
    {
        return ['role' => MessageRole::USER, 'content' => $content];
    }

    public static function system(string $content): array
    {
        return ['role' => MessageRole::SYSTEM, 'content' => $content];
    }

    public static function assistant(string $content): array
    {
        return ['role' => MessageRole::ASSISTANT, 'content' => $content];
    }

    public static function chat(array ...$messages): array
    {
        return $messages;
    }
}
