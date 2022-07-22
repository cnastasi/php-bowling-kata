<?php

namespace Nastasi\Bowling\Event;

class BallThrown
{
    public function __construct(public readonly int $pinsHit)
    {
    }
}