<?php

namespace Nastasi\Bowling;

use Nastasi\Bowling\Event\BallThrown;
use Nastasi\Bowling\Event\EventStore;

final class ScoreCalculator
{
    private const TOTAL_FRAMES = 10;

    public function __construct(
        private readonly EventStore   $store,
        private readonly FrameBuilder $frameBuilder
    )
    {
    }

    public function calculate(): int
    {
        $events = $this->getOnlyBallThrownEvents();
        $frames = $this->frameBuilder->build(...$events);
        $score = $this->calculateScore(...$frames);
        $bonus = $this->calculateBonus(...$frames);

        return $score + $bonus;
    }

    /**
     * @return BallThrown[]
     */
    public function getOnlyBallThrownEvents(): array
    {
        $events = $this->store->list();

        return array_filter($events, static fn(object $event) => $event instanceof BallThrown);
    }

    public function calculateScore(GameFrame ...$frames): int
    {
        $calculateScore = static fn(int $result, GameFrame $frame) => $frame->totalScore() + $result;

        return array_reduce($frames, $calculateScore, 0);
    }

    private function calculateBonus(GameFrame ...$frames): int
    {
        $framesLimit = min(self::TOTAL_FRAMES, count($frames));

        $bonus = 0;

        for ($i = 0; $i < $framesLimit; $i++) {
            $frame = $frames[$i];

            $bonus += match(true) {
                $frame->isSpare() => $this->giveNextScore($i, ...$frames),
                $frame->isStrike() => $this->giveNextTwoScores($i, ...$frames),
                default => 0
            };
        }

        return $bonus;
    }

    private function giveNextScore(int $currentIndex, GameFrame ...$frames): int
    {
        return $frames[$currentIndex + 1]?->firstThrow ?? 0;
    }

    private function giveNextTwoScores(int $currentIndex, GameFrame ...$frames): int
    {
        $frame = $frames[$currentIndex + 1];
        return $frame?->totalScore() ?? 0;
    }
}