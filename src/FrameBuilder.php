<?php

namespace Nastasi\Bowling;

use Nastasi\Bowling\Event\BallThrown;

final class FrameBuilder
{
    /**
     * @param BallThrown ...$events
     * @return GameFrame[]
     */
    public function build(BallThrown ...$events): array
    {
        $frames = [];

        for ($i = 0; $i < count($events); $i += 2) {
            $throw1 = $events[$i]->pinsHit;

            if ($throw1 === 10) {
                $throw2 = 0;
                $i --;
            } else {
                $throw2 = $events[$i + 1]?->pinsHit ?? 0;
            }

            $frames[] = new GameFrame($throw1, $throw2 ?? 0);
        }

        return $frames;
    }
}