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

function userChat($client)
{
    echo '~Start Chat' . PHP_EOL;
    $chat = 'Helo, how are you?';

    $response = $client->chat([MessageBuilder::user($chat)]);

    print_r($response);
}

function systemChat($client)
{
    echo '~Start System' . PHP_EOL;
    $system = 'What is your name?';
    $chat = 'What is PHP?';

    $response = $client->chat([
        MessageBuilder::system($system),
        MessageBuilder::user($chat),
    ]);

    print_r($response);
}

function assistenChat($client)
{
    echo '~Start Assistant' . PHP_EOL;
    $response = $client->chat(
        [
            MessageBuilder::system(
                'You are an AI assistant that helps people find information.',
            ),
            MessageBuilder::user('what is PHP?'),
            MessageBuilder::assistant(
                'PHP is a server-side scripting language used for web development.',
            ),
            MessageBuilder::user(
                'What is the difference between PHP and JavaScript?',
            ),
        ],
        // ['max_tokens' => 1000], //
    );

    print_r($response);
}

//this is just an example, run in terminal: php example/chat.php
userChat($client);
systemChat($client);
assistenChat($client);
