<?php
// This removes the need for nullable callable arguments and boilerplate null-checking,
// providing a functional default.
/**
 * Filters an array, defaulting to filtering out "empty" values.
 */
function custom_array_filter(
    array $array,
    // The Closure is a constant expression default parameter value
    Closure $callback = static function (mixed $item): bool {
        return !empty(trim((string) $item));
    },
): array {
    $result = [];
    foreach ($array as $item) {
        if ($callback($item)) {
            $result[] = $item;
        }
    }
    return $result;
}

$data = [0, 1, ' ', 'foo', null, false];
// Uses the default closure
$filtered = custom_array_filter($data);

// Output: array(2) { [0]=> int(1) [1]=> string(3) "foo" }
var_dump($filtered);