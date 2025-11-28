<?php
class Settings
{
    // Attaching metadata to a constant
    #[Deprecated(message: 'Use self::API_V2_ENDPOINT instead.', since: '1.5')]
    public const string API_V1_ENDPOINT = 'https://api.example.com/v1';

    public const string API_V2_ENDPOINT = 'https://api.example.com/v2';
}

// When you use this constant, PHP will emit a deprecation warning:
// Deprecated: Settings::API_V1_ENDPOINT is deprecated since 1.5. Use self::API_V2_ENDPOINT instead.
echo Settings::API_V1_ENDPOINT;