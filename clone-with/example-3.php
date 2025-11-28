<?php
readonly class MailConfig
{
    public function __construct(
        public string $host,
        public int $port = 25,
        public bool $useTls = true,
        public int $timeout = 10,
    ) {}

    /**
     * Returns a new MailConfig with a different port number.
     */
    public function withPort(int $port): self
    {
        return clone($this, ['port' => $port]);
    }

    /**
     * Returns a new MailConfig with a different timeout.
     */
    public function withTimeout(int $timeout): self
    {
        // Change multiple properties at once if needed
        return clone($this, [
            'timeout' => $timeout,
            'port' => 465 // Can also change another default if required
        ]);
    }
}

$defaultConfig = new MailConfig('smtp.example.com');
$apiConfig = $defaultConfig->withTimeout(30);

// Use of the new object
echo "Default Port: " . $defaultConfig->port . "\n";
echo "API Config Port: " . $apiConfig->port . " (changed via withTimeout)\n";
echo "API Config Timeout: " . $apiConfig->timeout . "\n";
