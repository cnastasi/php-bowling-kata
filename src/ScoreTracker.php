<?php

namespace Nastasi\Bowling;

use Nastasi\Bowling\Event\BallThrown;
use Nastasi\Bowling\Event\EventStore;

final class ScoreTracker
{
    public function __construct(private readonly EventStore $store)
    {
    }

    public function track(int $pinsHit): void
    {
        $this->store->store(new BallThrown($pinsHit));
    }
}