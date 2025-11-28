<?php
/**
 * A simple redirect-and-validate example using the new URI API.
 * Redirect HTTP to HTTPS and safely keep the path and query:
 */

use Uri\Rfc3986\Uri;
use Uri\UriComparisonMode;

// Imagine this comes from an incoming request URL you need to validate and normalize
$incoming = "http://Example.COM/products/list?page=1&sort=price%2Bdesc";

// 1) Parse and validate strictly (RFC 3986)
$uri = Uri::parse($incoming);
if ($uri === null) {
    http_response_code(400);
    exit("Bad URL");
}

// 2) Normalize for consistent routing/logging (lowercase host, clean path)
$normalized = $uri->toString(); // https://example.com/... once we change scheme below
error_log("Normalized request: " . $normalized);

// 3) Enforce HTTPS by immutably changing just the scheme
$secure = $uri->withScheme("https");

// 4) Preserve path and query exactly as provided (safe for caches/signing)
$target = $secure->toString(); // normalized RFC 3986 string

// 5) Compare ignoring fragment (default) to avoid duplicate redirects
if (!$secure->equals($uri, UriComparisonMode::ExcludeFragment)) {
    header("Location: " . $target, true, 301);
    exit;
}

// Continue serving the HTTPS request...