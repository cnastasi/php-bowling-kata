Feature: Calculate a score after a series of strikes

  Scenario: Zero strikes
    Given a new game
    Then the score is 0

  Scenario: One throw
    Given a new game
    When a strike hit 7 pins
    Then the score is 7

  Scenario: Two throws
    Given a new game
    When a strike hit 7 pins
    And a strike hit 2 pins
    Then the score is 9

  Scenario: One spare
    Given a new game
    When a strike hit 7 pins
    And a strike hit 3 pins
    And a strike hit 5 pins
    Then the score is 20

  Scenario: One strike
    Given a new game
    When a strike hit 10 pins
    And a strike hit 5 pins
    And a strike hit 3 pins
    Then the score is 26