<?php
// The following example allows defining default logic for an object's
// behavior right on the property declaration.
class Transformer
{
    // CORRECT: Omit the type declaration for the constant.
    public const DEFAULT_FORMATTER = static function (string $value): string {
        return ucfirst(strtolower(trim($value)));
    };

    // The property uses the static closure as its default. The property type is correct.
    private Closure $formatter = self::DEFAULT_FORMATTER;

    public function __construct(
        private string $value
    ) {}

    public function format(): string
    {
        return ($this->formatter)($this->value);
    }
}

$t = new Transformer("  hElLo wOrLd!  ");
echo $t->format(); // Output: Hello world! // Output: Hello world!