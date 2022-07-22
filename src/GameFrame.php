<?php

namespace Nastasi\Bowling;

final class GameFrame
{
    public function __construct(public readonly int $firstThrow, public readonly int $secondThrow)
    {
        $this->validate();
    }

    public function isSpare(): bool
    {
        return !$this->isStrike()
            && ($this->totalScore() === 10);
    }

    public function isStrike(): bool
    {
        return $this->firstThrow === 10;
    }

    public function totalScore(): int {
        return $this->firstThrow + $this->secondThrow;
    }

    private function validate(): void
    {
        if ($this->firstThrow < 0 || $this->secondThrow < 0 || $this->totalScore() > 10) {
            throw new \ValueError('Invalid game frame values');
        }
    }


}