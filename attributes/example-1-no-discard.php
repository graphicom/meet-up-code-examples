<?php
readonly class Configuration
{
    public function __construct(public bool $debugMode = false) {}

    #[NoDiscard("The returned object is the NEW, modified configuration.")]
    public function withDebugMode(bool $debugMode): self
    {
        return clone($this, ['debugMode' => $debugMode]);
    }
}

$config = new Configuration();

// ❌ WARNING: The return value of function withDebugMode() is expected to be consumed,
// you must use this return value, it's very important.
$config->withDebugMode(true);

// ✅ OK: The return value is consumed
$newConfig = $config->withDebugMode(true);

// You can explicitly discard the warning using the (void) cast if intended
(void) $config->withDebugMode(false);