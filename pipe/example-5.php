<?php
/**
 * Mathematical transformations
 */
$number = 3;

/**
 * Before 8.5, Nested Function Structure
 */
$result_before = round(sqrt($number * 5), 2);

echo $result_before;

/**
 * New with 8.5 Pipe Operator
 */
$result_after = $number
        |> (fn($x) => $x * 5)
        |> sqrt(...)
        |> (fn($x) => round($x, 2));

echo $result_after;