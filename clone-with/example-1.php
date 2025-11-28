<?php
/**
 * Clone With
 */
readonly class Color
{
    public function __construct(
        public int $red,
        public int $green,
        public int $blue,
        public int $alpha = 255,
    ) {}

    /**
     * Creates a new instance of the object with the specified alpha value.
     *
     * @param int $alpha The alpha value to be set in the new instance.
     * @return self A new instance of the object with the updated alpha value.
     */
    public function withAlpha(int $alpha): self
    {
        $values = get_object_vars($this);
        $values['alpha'] = $alpha;

        return new self(...$values);
    }

    /**
     * Creates and returns a cloned instance with the specified alpha value.
     *
     * @param int $alpha The alpha value to set in the cloned instance.
     * @return self A new instance with the updated alpha value.
     */
    public function withAlphaCloned(int $alpha): self
    {
        return clone($this, [
            'alpha' => $alpha,
        ]);
    }

    public function __toString(): string
    {
        return "rgba({$this->red}, {$this->green}, {$this->blue}, {$this->alpha})";
    }
}

$blue = new Color(79, 91, 147);
$transparentBlue = $blue->withAlpha(128);

$transparentBlueCloned = $blue->withAlphaCloned(127);

echo "before clone with : " . $transparentBlue;
echo "\n";
echo "After clone with :" . $transparentBlueCloned;
