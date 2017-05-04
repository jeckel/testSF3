<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given there is :arg1, which is :arg2
     */
    public function thereIsWhichIs($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then Mysql status is :arg1
     */
    public function mysqlStatusIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then Redis status is :arg1
     */
    public function redisStatusIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then App status is :arg1
     */
    public function appStatusIs($arg1)
    {
        throw new PendingException();
    }

}
