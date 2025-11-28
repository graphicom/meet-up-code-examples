<?php
ini_set('memory_limit', '2M');

function my_heavy_function(): void {
    $str = str_repeat('A', 1024 * 1024 * 5);
}

my_heavy_function();