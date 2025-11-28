<?php
/**
 * Example with simple strings
 */
$name = "  doesn't Works  ";

/**
 * Before 8.5 Nested Function Structure
 */
$result_before = "It, " . strtoupper(preg_replace("/doesn't/i", "does", trim($name))) . "!";

echo $result_before;

/**
 * New with 8.5 Pipe Operator
 */
 $result_after = $name
    |> trim(...)
    |> (fn($s) => preg_replace("/doesn't/i", "does", $s))
    |> strtoupper(...)
    |> (fn($s) => "It, $s!");

echo $result_after;