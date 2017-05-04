<?php
/**
 * Created by PhpStorm.
 * User: jeckel
 * Date: 04/05/17
 * Time: 08:56
 */

namespace tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatusControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/status/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"APP":true,"MYSQL":true,"REDIS":true}', $client->getResponse()->getContent());
    }
}
