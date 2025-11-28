<?php
use Uri\Rfc3986\Uri;
use Uri\WhatWg\Url;

// Parsing a generic URI (RFC 3986)
$uri = Uri::parse("https://user:pass@example.com:8080/path?q=1#frag");
echo $uri->getScheme(). "\n";   // "https"
echo $uri->getHost(). "\n";     // "example.com"
echo $uri->getPort(). "\n";     // 8080
echo $uri->getPath(). "\n";     // "/path"
echo $uri->getQuery(). "\n";    // "q=1"
echo $uri->getFragment(). "\n"; // "frag"

// Modifying immutably
$newUri = $uri
    ->withScheme("http")
    ->withPort(null)
    ->withPath("/newpath");
echo $newUri->toString(). "\n"; // "http://example.com/newpath?q=1#frag"

// Parsing a browser-style URL (WHATWG)
// Create a new URL object; normalization happens automatically during parsing
$url = Url::parse('https://portal.gov.ma/../../etc/passwd?x=1#hello');

// The normalization protects against path traversal attacks
echo $url->getPath(). "\n"; // Output: "/etc/passwd"
// Accessing components
echo $url->getScheme(). "\n"; // Output: "https"
echo $url->getAsciiHost(). "\n";   // Output: "portal.gov.ma"

// Creating a new immutable instance with changes
$newUrl = $url->withPath('/new-dashboard');
echo $newUrl->toAsciiString(). "\n"; // Output: "portal.gov.ma"
