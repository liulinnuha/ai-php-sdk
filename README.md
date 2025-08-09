# 🤖 AI PHP SDK

[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.4-blue.svg)](https://www.php.net/)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D8-blue.svg)](https://www.php.net/)
[![Latest Version](https://img.shields.io/packagist/v/liulinnuha/ai-php-sdk.svg)](https://packagist.org/packages/liulinnuha/ai-php-sdk)
[![License](https://img.shields.io/packagist/l/liulinnuha/ai-php-sdk.svg)](LICENSE.md)

A PHP-agnostic SDK for seamless integration with various AI providers including DeepSeek, OpenAI, Gemini, and more. Supporting chat, embedding, moderation features, and provider-specific endpoints.

## 📋 Table of Contents
- [Features](#-features)
- [Supported Providers](#-supported-providers)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [FAQ](#-faq)
- [Contributing](#-contributing)
- [License](#-license)

## ✨ Features

- **🌐 Multi Provider Support**
  - Seamless integration with popular AI providers
  - Easy provider switching
  - Unified API interface

- **💬 Chat API**
  - Real-time chat capabilities
  - Stream response support
  - History management
  - Custom message formatting

- **🔤 Embedding API**
  - Text-to-vector conversion
  - Semantic search support
  - Multiple embedding models
  - Vector manipulation utilities

- **🛡️ Moderation API**
  - Content safety checking
  - Multi-language support
  - Customizable threshold
  - Detailed response analysis

## 🔌 Supported Providers

| Provider | Status | Features |
|----------|--------|----------|
| DeepSeek | ✅ Active | Chat, Embedding |
| OpenAI   | ✅ Active | Chat, Embedding, Moderation |
| Gemini   | ✅ Active | Chat |

## 📦 Installation

```bash
composer require liulinnuha/ai-php-sdk
```

## ⚙️ Configuration
### Basic Setup
```php
return [
    'default' => 'deepseek',

    'api_keys' => [
        'deepseek' => 'YOUR_DEEPSEEK_API_KEY',
        'openai'   => 'YOUR_OPENAI_API_KEY',
        'gemini'   => 'YOUR_GEMINI_API_KEY',
    ],

    'models' => [
        'deepseek' => 'deepseek-chat',
        'openai'   => 'gpt-4-mini',
        'gemini'   => 'gemini-pro',
    ],
];
```

## 🚀 Usage
### Chat API
```php
use AiPhpSdk\Client;
use AiPhpSdk\Support\MessageBuilder;

// Initialize client
$client = new Client($config['default'], [
    'api_key' => $config['api_keys'][$config['default']],
    'model'   => $config['models'][$config['default']],
]);

// Simple chat
$response = $client->chat([
    MessageBuilder::user('Hello, who are you?')
]);

// Chat with history
$response = $client->chat([
    MessageBuilder::system('You are a helpful assistant.'),
    MessageBuilder::user('Hi!'),
    MessageBuilder::assistant('Hello! How can I help you?'),
    MessageBuilder::user('Tell me about AI.'),
]);
```

### Embedding API
// Generate embeddings
```php
$embeddings = $client->embedding('Text to convert to vector');

// Multiple texts
$embeddings = $client->embedding([
    'First text',
    'Second text'
]);
```
### Moderation API
```php
// Check content safety
$result = $client->moderate('Text to check');
```

## ❓ FAQ
#### How to switch providers?
#### Change the 'default' value in configuration or use setProvider() method:
```php
$client->setProvider('openai');
```
## 🤝 Contributing
Contributions are welcome! Please feel free to submit a Pull Request or create an Issue for:
Bug fixes
Feature requests
Documentation improvements
Code optimization
## 📄 License
This package is licensed under the MIT License.
