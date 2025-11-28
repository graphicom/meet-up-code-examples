<?php
/**
 * Clean up JSON from some API
 */
$json = '{ "price": " 199 ", "status": " ok  " }';

/**
 * Before 8.5, Nested Function Structure
 */
$price_before = intval(
    trim(
        json_decode($json, true)['price']
    )
);

echo $price_before;

/**
 * New with 8.5 Pipe Operator
 */
$price_after = $json
        |> (fn($s) => json_decode($s, true))
        |> (fn($data) => $data['price'])
        |> trim(...)
        |> intval(...);

echo $price_after;