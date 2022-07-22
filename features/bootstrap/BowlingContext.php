<?php

use Behat\Behat\Context\Context;
use Nastasi\Bowling\Event\EventStoreImpl;
use Nastasi\Bowling\FrameBuilder;
use Nastasi\Bowling\Game;
use Nastasi\Bowling\ScoreCalculator;
use Nastasi\Bowling\ScoreTracker;
use PHPUnit\Framework\Assert;

class BowlingContext implements Context
{
    private Game $game;

    /**
     * @Given a new game
     */
    public function aNewGame()
    {
        $eventStore = new EventStoreImpl();
        $tracker = new ScoreTracker($eventStore);
        $calculator = new ScoreCalculator($eventStore, new FrameBuilder());

        $this->game = new Game($tracker, $calculator);
    }

    /**
     * @Then the score is :score
     */
    public function theScoreIs(int $score)
    {
        Assert::assertEquals($score, $this->game->score());
    }

    /**
     * @When a strike hit :pins pins
     */
    public function aStrikeHitPins(int $pins)
    {
        $this->game->strike($pins);
    }
}
