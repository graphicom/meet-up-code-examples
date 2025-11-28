<?php
/**
 * Example with arrays
 */
$data = ["  apple", "banana  ", "  kiwi  "];

/**
 * Before 8.5, Nested Function Structure
 */
$result_before = array_values(
    array_filter(
        array_map('trim', $data),
        function ($x) {
            return strlen($x) > 4;
        }
    )
);

print_r($result_before);

/**
 * New with 8.5 Pipe Operator
 */
$result_after = $data
        |> (fn($items) => array_map('trim', $items))(...)
        |> (fn($items) => array_filter($items, fn($x) => strlen($x) > 4))(...)
        |> array_values(...);

print_r($result_after);