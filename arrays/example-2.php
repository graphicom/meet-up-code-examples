<?php
// Before PHP 8.5 issue with pointers
$data = ['A', 'B', 'C', 'D'];

// 1. Advance the pointer twice
next($data); // Pointer moves to 'B'
next($data); // Pointer moves to 'C'

echo "After next(next()): " . current($data) . "\n";
// Output: C

// 2. Use reset() to get the first value (A)
$first_value = reset($data); // Side effect: The pointer is moved to 'A'
echo "Value from reset(): " . $first_value . "\n";
// Output: A

// 3. Check the pointer state again
echo "Pointer after reset(): " . current($data) . "\n";
// Output: A
// The pointer was forced back to the beginning ('A'), ignoring its previous state ('C').
//------------------------------------------------------------------------------------
// After PHP 8.5

/*// 1. Advance the pointer twice
next($data); // Pointer moves to 'B'
next($data); // Pointer moves to 'C'

echo "After next(next()): " . current($data) . "\n";
// Output: C

// 2. Use array_first() to get the first value (A)
$first_value = array_first($data); // No side effect: The pointer is NOT moved
echo "Value from array_first(): " . $first_value . "\n";
// Output: A

// 3. Check the pointer state again
echo "Pointer after array_first(): " . current($data) . "\n";
// Output: C
// The pointer correctly stayed at 'C', which was its state before the function call.*/
