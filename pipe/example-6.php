<?php
/**
 * Processing uploaded CSV rows
 * Clean, validate, and map rows into DTOs in one flow.
 */

// 1. Define the Product Data Transfer Object (DTO)
class Product
{
    public function __construct(
        public string $name,
        public float $price,
        public string $sku
    ) {}

    // Factory method to create Product from the normalized array row
    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['price'], // Price is guaranteed to be a valid float here
            $data['sku']
        );
    }

    // Helper for clean output display
    public function __toString(): string
    {
        return "Product('{$this->name}', {$this->price}, '{$this->sku}')";
    }
}

// 2. Define the normalizeRow function
/**
 * Cleans and transforms a raw CSV row.
 * - Trims whitespace from name and SKU.
 * - Attempts to cast price to a float; sets to null on failure or if <= 0.
 * - Unifies name casing (Title Case for display/storage consistency).
 */
function normalizeRow(array $row): array
{
    // Clean strings
    $name = ucwords(strtolower(trim($row['name'])));
    $sku = strtoupper(trim($row['sku']));

    // Validate and cast price
    $price = filter_var($row['price'], FILTER_VALIDATE_FLOAT);

    // Set price to null if validation fails or if it's not a positive number
    if ($price === false || $price <= 0) {
        $price = null;
    }

    return [
        'name' => $name,
        'price' => $price, // null if invalid, float otherwise
        'sku' => $sku,
    ];
}

// 3. Define the isValidRow function
/**
 * Checks if a normalized row is valid for conversion to a Product DTO.
 * A row is valid if the 'price' field is a non-null float (i.e., successfully normalized).
 */
function isValidRow(array $row): bool
{
    // After normalization, an invalid price is represented as null.
    // Check if the price is a float (which implicitly means it's not null and > 0).
    return is_float($row['price']);
}

// --- Input Data ---
$rows = [
    ['name' => ' Widget A ', 'price' => '12.99', 'sku' => 'W-A'],
    ['name' => 'Widget B',   'price' => 'n/a',   'sku' => 'W-B'],    // invalid price, will be filtered
    ['name' => 'widget c',   'price' => '7.5',   'sku' => 'W-C'],
    ['name' => 'Widget D',   'price' => '0.00',  'sku' => 'W-D'],    // non-positive price, will be filtered
];

// --- The Functional Processing Pipeline (using the Pipe Operator) ---
// Note: The Pipe Operator (`|>`) is available in PHP 8.1 and later.

$products = $rows
        // Stage 1: Normalize all rows (Clean, cast, unify)
        |> (fn($xs) => array_map('normalizeRow', $xs))

        // Stage 2: Validate rows (Filter out invalid data points)
        |> (fn($xs) => array_filter($xs, 'isValidRow'))

        // Stage 3: Map valid rows to DTOs (The final data structure)
        |> (fn($xs) => array_map(Product::fromArray(...), $xs));

// --- Output ---
echo "✅ Processed Products:\n";
foreach ($products as $product) {
    echo "- " . $product . "\n";
}

// Expected Output:
// - Product('Widget A', 12.99, 'W-A')
// - Product('Widget C', 7.5, 'W-C')