<?php

require __DIR__ . '/../vendor/autoload.php';

use AiPhpSdk\Client;
use AiPhpSdk\Support\MessageBuilder;

// Load config
$config = require __DIR__ . '/../config/ai-sdk.php';

// Setup client
$client = new Client($config['default'], [
    'api_key' => $config['api_keys'][$config['default']],
    'model' => $config['models'][$config['default']],
]);

/** @var \AiPhpSdk\Providers\DeepSeekProvider $provider */
$provider = $client->getProvider();
if (method_exists($provider, 'getBalance')) {
    $balance = $provider->getBalance();
    print_r($balance);
} else {
    echo 'This provider does not support balance check.';
}
