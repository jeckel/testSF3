Feature: Status application
  Test if the status service is answering correct value corresponding
  to any dependent services (like MySQL and Redis)

  Scenario: MySQL and Redis are working
    Given there is "Mysql", which is "working"
    And there is "Redis", which is "working"
    When I go to "/status/"
    Then Mysql status is "working"
    And Redis status is "working"
    And App status is "working"

  Scenario: MySQL is working and Redis is not
    Given there is "Mysql", which is "working"
    And there is "Redis", which is "not working"
    When I go to "/status/"
    Then Mysql status is "working"
    And Redis status is "not working"
    And App status is "not working"

  Scenario: MySQL is not working and Redis is
    Given there is "Mysql", which is "not working"
    And there is "Redis", which is "working"
    When I go to "/status/"
    Then Mysql status is "not working"
    And Redis status is "working"
    And App status is "not working"

  Scenario: MySQL and Redis are not working
    Given there is "Mysql", which is "not working"
    And there is "Redis", which is "not working"
    When I go to "/status/"
    Then Mysql status is "not working"
    And Redis status is "not working"
    And App status is "not working"
