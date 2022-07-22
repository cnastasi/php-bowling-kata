<?php

namespace Nastasi\Bowling\Event;

class EventStoreImpl implements EventStore
{
    /** @var object[] */
    private array $events = [];

    public function store(object $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @inheritDoc
     */
    public function list(): array
    {
        return $this->events;
    }
}