<?php

namespace AiPhpSdk\Contracts;

interface AiProviderInterface
{
    /**
     * Chat with the AI provider.
     *
     * @param array $messages
     * @return array
     */
    public function chat(array $messages): array;
}
