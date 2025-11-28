<?php
$planets = ['Mercury', 'Venus', 'Earth', 'Mars'];
$user = ['id' => 101, 'name' => 'Alice', 'role' => 'Admin'];
$emptyArray = [];

// Indexed Array
$firstPlanet = array_first($planets); // 'Mercury'
$lastPlanet = array_last($planets);  // 'Mars'

// Associative Array
$firstData = array_first($user); // 101
$lastData = array_last($user);  // 'Admin'

// Empty Array
$firstEmpty = array_first($emptyArray); // null
$lastEmpty = array_last($emptyArray);   // null

echo "First planet: " . $firstPlanet . "\n";
echo "Last planet: " . $lastPlanet . "\n";