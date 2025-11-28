<?php
/**
 * Using methods inside pipes,
 * You can use object methods too:
 */
class Text {
    public function __construct(public string $text) {}

    public function lower(): string {
        return strtolower($this->text);
    }

    public function add($suffix): string {
        return $this->text . $suffix;
    }
}

$t = new Text("    HELLO");

/**
 * Before 8.5, Nested Function Structure
 */
$result_before = trim($t->add(" World   ")) . " !";

echo $result_before;

/**
 * New with 8.5 Pipe Operator
 */
$result_after = $t
    |> (fn($x) => $x->add(" World   "))
    |> trim(...)
    |> (fn($x) => $x . " !");

echo $result_after;