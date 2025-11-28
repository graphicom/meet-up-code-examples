<?php
// 1. Create or retrieve a persistent cURL share handle.
// The array specifies what to share. CURL_LOCK_DATA_COOKIE is NOT allowed.
$share_options = [
    CURL_LOCK_DATA_DNS,
    CURL_LOCK_DATA_CONNECT
];
$sh = curl_share_init_persistent($share_options);

// If this code is run multiple times in a persistent SAPI (like FPM),
// subsequent requests with the SAME $share_options will reuse the existing $sh.

// --- First cURL Request ---
// This request will perform a DNS lookup and establish a connection.
$ch1 = curl_init("http://example.com/");
curl_setopt($ch1, CURLOPT_SHARE, $sh);
curl_exec($ch1);

// At this point, the DNS information and the connection might be kept alive
// and stored in the persistent share handle $sh.

// --- Second cURL Request (in the same PHP request) ---
// This request to the SAME host will REUSE the connection and DNS info from $ch1.
$ch2 = curl_init("http://example.com/");
curl_setopt($ch2, CURLOPT_SHARE, $sh);
curl_exec($ch2);

// --- Third cURL Request (in a subsequent PHP request) ---
// If this script is run again, $sh will be REUSED due to persistence.
// A new $ch3 will be created, and it will REUSE the connection and DNS info
// from the first run's $sh handle.
// $ch3 = curl_init("http://example.com/");
// curl_setopt($ch3, CURLOPT_SHARE, $sh);
// curl_exec($ch3);

// Note: Persistent share handles are not explicitly closed.
// They are managed by the PHP engine/SAPI and persist for the lifetime of the worker.