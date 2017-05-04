<?php
/**
 * Created by PhpStorm.
 * User: jeckel
 * Date: 04/05/17
 * Time: 08:56
 */

namespace tests\AppBundle\Controller;

use AppBundle\Service\MysqlStatus;
use AppBundle\Service\RedisStatus;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatusControllerTest extends WebTestCase
{
    protected $mysql_file;

    protected $redis_file;

    public function setUp()
    {
        $var_dir = static::$kernel->getRootDir() . '/../var/';
        $this->mysql_file = $var_dir . MysqlStatus::FILE_NAME;
        $this->redis_file = $var_dir . RedisStatus::FILE_NAME;

        if (file_exists($this->redis_file)) {
            unlink($this->redis_file);
        }
        if (file_exists($this->mysql_file)) {
            unlink($this->mysql_file);
        }
    }

    public function testIndexAllServicesRunning()
    {
        $client = static::createClient();

        touch($this->mysql_file);
        touch($this->redis_file);

        $client->request('GET', '/status/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"APP":true,"MYSQL":true,"REDIS":true}', $client->getResponse()->getContent());
    }

    public function testIndexAllServicesDown()
    {
        $client = static::createClient();

        $client->request('GET', '/status/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"APP":false,"MYSQL":false,"REDIS":false}', $client->getResponse()->getContent());
    }
    public function testIndexMySQLDown()
    {
        $client = static::createClient();

        touch($this->redis_file);

        $client->request('GET', '/status/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"APP":false,"MYSQL":false,"REDIS":true}', $client->getResponse()->getContent());
    }
    public function testIndexRedisDown()
    {
        $client = static::createClient();

        touch($this->mysql_file);

        $client->request('GET', '/status/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"APP":false,"MYSQL":true,"REDIS":false}', $client->getResponse()->getContent());
    }

}
