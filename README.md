# PHP 8.5 – Meet‑Up Presentation Examples

This repository contains small, focused examples prepared for a meet‑up talk, showcasing a selection of features and proposals around PHP 8.5 (and a few related concepts). Each directory groups one topic with minimal, runnable snippets you can try locally.

Note: Some examples illustrate features that may be available only in PHP 8.5 (or a nightly/dev build) or behind experimental flags. Treat them as educational samples; on older PHP versions they might not run or may require polyfills.

## Requirements
- PHP 8.5 (preferably latest nightly/dev if you want to try the brand‑new features)
- CLI access to run `php` scripts

## How to run the examples
From the project root, run any file with the PHP CLI:

```
php arrays/example-1.php
php pipe/example-1.php
php attributes/example-1-no-discard.php
```

Each snippet is self‑contained and prints its output to the console.

## Contents

### 1) Arrays helpers (pointer‑safe first/last)
Folder: `arrays/`

- `example-1.php` – Demonstrates `array_first()` and `array_last()` on indexed and associative arrays (and empty arrays), returning values without mutating the internal array pointer.
- `example-2.php` – Shows the difference between legacy pointer‑moving functions (like `reset()`) and pointer‑safe helpers (`array_first()`), contrasting behavior before vs. after PHP 8.5.

Run:
```
php arrays/example-1.php
php arrays/example-2.php
```

### 2) Attributes
Folder: `attributes/`

- `example-1-no-discard.php` – Uses `#[NoDiscard]` to warn when a return value (from a builder/with‑method) is ignored. Demonstrates explicitly discarding with `(void)`.
- `example-2-override.php` – Uses `#[Override]` to enforce that a child class property truly overrides a parent one, catching typos at compile time.

Run:
```
php attributes/example-1-no-discard.php
php attributes/example-2-override.php
```

### 3) Clone‑with (immutable object ergonomics)
Folder: `clone-with/`

- `example-1.php` – A `Color` value object shows two approaches to derive a modified copy: a manual constructor spread and a concise `clone($this, [ 'alpha' => 127 ])` style call.
- `example-2.php`, `example-3.php`, `example-4.php` – Additional variations on cloning with selective property changes.

Run:
```
php clone-with/example-1.php
```

### 4) Closures and first‑class callables
Folder: `closure/`

- `example-1.php`, `example-2.php` – First‑class callable syntax (`...`) usage patterns.
- `example-3.php` – Exemplifies storing first‑class callables as constants. Depending on your PHP build, using expressions as constant values may not be allowed yet; treat this as an illustrative sample.

Run:
```
php closure/example-1.php
php closure/example-2.php
```

### 5) Pipe operator (functional pipelines)
Folder: `pipe/`

- `example-1.php` – String cleanup and formatting, contrasting nested calls vs. a readable pipeline with `|>`.
- `example-2.php` – Array transform/filter/value‑extraction as a pipeline.
- `example-3.php`, `example-4.php`, `example-5.php`, `example-6.php` – More involved scenarios, including mapping validated CSV rows into DTOs (`example-6.php`).

Run:
```
php pipe/example-1.php
php pipe/example-2.php
php pipe/example-6.php
```

### 6) URI/URL parsing and immutability
Folder: `uri/`

- `example.php` – Demonstrates parsing and immutable modification using `Uri\Rfc3986\Uri` and `Uri\WhatWg\Url`. Shows safe normalization, component access, and `.with*()` methods.
- `example-1.php`, `example-2.php`, `example-3.php` – Additional focused samples on specific aspects (scheme/host/port/path/query/fragment, normalization, etc.).

Note: These classes may require the upcoming/extensional URI support or a library that implements them. If you do not have them available, treat the files as reference examples.

Run:
```
php uri/example.php
```

### 7) cURL
Folder: `curl/`

- `example.php` – Minimal sample using cURL APIs in a modern style (ensure the `curl` extension is enabled).

Run:
```
php curl/example.php
```

### 8) Fatal error handling demo
Folder: `fatal-error-handling/`

- `example-1.php` – Intentionally sets a tiny `memory_limit` and allocates a large string to trigger a fatal error. Useful for observing behavior/logging and handler strategies.

Run (expect a fatal error):
```
php fatal-error-handling/example-1.php
```

## Tips
- If an example does not run on your PHP build, it likely targets a newer feature. Try a PHP 8.5 nightly build or use the file as a conceptual reference.
- Each script is tiny on purpose—open them to see the full story; comments explain the rationale and expected output.
- A google slide exist to help understand the new features at this link https://docs.google.com/presentation/d/1TBdLzxpZ0a2AL_kHL9XAbDBzIae7nnl-/edit?usp=sharing&ouid=108666708947416689654&rtpof=true&sd=true

## License
MIT (or the license you presented this with at the meet‑up). Feel free to reuse these snippets in your own talks and demos.
