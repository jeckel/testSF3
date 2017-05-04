Feature: Status application


  Scenario: MySQL and Redis are working
    Given there is "Mysql", which is "running"
    And there is "Redis", which is "running"
    When I go to "/status/"
    Then Mysql status is "running"
    And Redis status is "running"
    And App status is "running"