<?php

/**
 * First-Class Callable in a Class Constant
 * This example defines a class constant that holds a reference to the global array_map function, which can
 * be useful for configuring or injecting utility functions.
 */
class ArrayUtilities
{
    // PHP 8.5 Feature: Use the First-Class Callable syntax (...)
    // to create a Closure pointing to the global array_map function.
    public const MAP_FUNCTION = \array_map(...);

    // Constant reference to another global function
    public const COUNT_FUNCTION = \count(...);
}

// 1. Access the constant (it is a Closure object)
$map = ArrayUtilities::MAP_FUNCTION;
$count = ArrayUtilities::COUNT_FUNCTION;

// 2. Execute the Closure retrieved from the constant
$data = [1, 2, 3];

// We use the $map closure to apply a transformation: static fn($n) => $n * 2
$doubled_data = $map(static fn($n) => $n * 2, $data);

// We use the $count closure
$count_result = $count($data);

echo "--- First-Class Callable Example ---\n";
echo "Original Data: " . implode(', ', $data) . "\n";
echo "Doubled Data (via MAP_FUNCTION constant): " . implode(', ', $doubled_data) . "\n";
echo "Count Result (via COUNT_FUNCTION constant): " . $count_result . "\n";