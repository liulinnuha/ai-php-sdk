<?php

namespace AiPhpSdk\Contracts;

interface SupportsEmbeddingInterface
{
    /**
     * Embed text.
     *
     * @param string $input
     * @return array
     */
    public function embed(string $input): array;
}
