<?php
/**
 * Basic RFC 3986 Parsing and Access
 * This example demonstrates how to use the Uri\Rfc3986\Uri class to securely parse a URI and access its individual
 * components (scheme, host, path, etc.).
 */
use Uri\Rfc3986\Uri;

// A complex URI
$inputUri = 'HTTPS://User:Password@example.com:8080/path/to/resource?query=value&foo=bar#fragment1';

// Create a new URI object
$uri = new Uri($inputUri);

echo "Scheme: " . $uri->getScheme() . "\n";     // Output: https
echo "User Info: " . $uri->getUserInfo() . "\n";   // Output: User:Password
echo "Host: " . $uri->getHost() . "\n";         // Output: example.com
echo "Port: " . $uri->getPort() . "\n";         // Output: 8080
echo "Path: " . $uri->getPath() . "\n";         // Output: /path/to/resource
echo "Query: " . $uri->getQuery() . "\n";       // Output: query=value&foo=bar
echo "Fragment: " . $uri->getFragment() . "\n";   // Output: fragment1