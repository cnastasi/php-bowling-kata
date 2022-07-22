<?php

namespace Nastasi\Bowling;

final class Game
{
    public function __construct(
        private readonly ScoreTracker    $tracker,
        private readonly ScoreCalculator $calculator
    )
    {
    }

    public function score(): int
    {
        return $this->calculator->calculate();
    }

    public function strike(int $pinsHit): void
    {
        $this->tracker->track($pinsHit);
    }


}