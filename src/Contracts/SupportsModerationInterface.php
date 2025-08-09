<?php

namespace AiPhpSdk\Contracts;

interface SupportsModerationInterface
{
    /**
     * Moderate text.
     *
     * @param string $input
     * @return array
     */
    public function moderate(string $input): array;
}
