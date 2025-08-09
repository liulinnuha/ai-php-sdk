<?php

namespace AiPhpSdk\Exceptions;

use Exception;

class AiSdkException extends Exception
{
    protected ?string $provider;

    public function __construct(
        string $message,
        int $code = 0,
        ?string $provider = null,
        ?Exception $previous = null,
    ) {
        $this->provider = $provider;

        $messageWithContext = $provider ? "[{$provider}] {$message}" : $message;

        parent::__construct($messageWithContext, $code, $previous);
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }
}
