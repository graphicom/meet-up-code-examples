<?php
/**
 * checking equality between two URIs/URLs.
 */
use Uri\Rfc3986\Uri;
use Uri\WhatWg\Url;

// By default, fragments are excluded

$u1 = new Uri("https://example.COM#foo");
$u2 = new Uri("https://EXAMPLE.COM");
var_dump($u1->equals($u2)); // true

$w1 = new Url("https:////example.COM/");
$w2 = new Url("https://EXAMPLE.COM");
var_dump($w1->equals($w2)); // true


// Include fragments when you need strict match
$u = new Uri("https://example.com#foo");
var_dump(
    $u->equals(
        new Uri("https://example.com"),
        \Uri\UriComparisonMode::IncludeFragment
    )
);
// false