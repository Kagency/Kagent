Feature: The main project milestones are described as features.

    Scenario: Register for RSS event source and replicate new entries to client
        When I create a task "RSS/NewFeed" with "http://kore-nordmann.de"
         And The processing is completed
        Then I receive "RSS/Entry" events 
