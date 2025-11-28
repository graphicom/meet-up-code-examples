<?php
readonly class DateRange
{
    public function __construct(
        public DateTimeImmutable $start,
        public DateTimeImmutable $end,
    ) {
    }

    /**
     * Returns a new DateRange with a modified start date.
     */
    public function withStart(DateTimeImmutable $newStart): self
    {
        return clone($this, ['start' => $newStart]);
    }

    /**
     * Returns a new DateRange with a modified end date.
     */
    public function withEnd(DateTimeImmutable $newEnd): self
    {
        return clone($this, ['end' => $newEnd]);
    }
}

$today = new DateTimeImmutable();
$aWeekFromNow = $today->modify('+7 days');
$twoWeeksFromNow = $today->modify('+14 days');

// Original Range: 7 days
$originalRange = new DateRange($today, $aWeekFromNow);

// New Range: Same start, but ends in 14 days
$extendedRange = $originalRange->withEnd($twoWeeksFromNow);

// Output for demonstration (start and end properties)
echo "Original Range Start: " . $originalRange->start->format('Y-m-d') . "\n";
echo "Extended Range End: " . $extendedRange->end->format('Y-m-d') . "\n";
echo "Are they the same object? " . ($originalRange === $extendedRange ? 'Yes' : 'No') . "\n";