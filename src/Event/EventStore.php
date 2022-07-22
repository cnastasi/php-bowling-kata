<?php

namespace Nastasi\Bowling\Event;

interface EventStore
{
    public function store(object $event): void;

    /**
     * @return object[]
     */
    public function list():array;
}