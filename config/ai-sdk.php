<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default AI Provider
    |--------------------------------------------------------------------------
    | Choose default provider: deepseek, openai, gemini, etc.
    */
    'default' => 'deepseek',

    /*
    |--------------------------------------------------------------------------
    | API Keys
    |--------------------------------------------------------------------------
    | Save api keys for each provider.
    */
    'api_keys' => [
        'deepseek' => 'YOUR_DEEPSEEK_API_KEY',
        'openai' => 'YOUR_OPENAI_API_KEY',
        'gemini' => 'YOUR_GEMINI_API_KEY',
    ],

    /*
    |--------------------------------------------------------------------------
    | Model Defaults
    |--------------------------------------------------------------------------
    | Model defaults for each provider.
    */
    'models' => [
        'deepseek' => 'deepseek-chat',
        'openai' => 'gpt-4o-mini',
        'gemini' => 'gemini-pro',
    ],
];
