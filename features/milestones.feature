Feature: The main project milestones are described as features.

    Background: A user exists
        Given A User "Kore" exists and is logged in


    Scenario: Register for RSS event source and replicate new entries to client
        When I create a task "Kagency\Module\RSS\Task\NewFeed" with "http://kore-nordmann.de"
         And The processing is completed
        Then I receive "RSS/Entry" events 
