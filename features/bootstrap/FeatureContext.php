<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    const WORKING = 'working';

    /**
     * @var string
     */
    protected $base_url;
    /**
     * @var string
     */
    protected $mysql_file;
    /**
     * @var string
     */
    protected $redis_file;
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;
    /**
     * @var stdClass
     */
    protected $response;


    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     * @param string $base_url
     */
    public function __construct(string $base_url)
    {
        $this->base_url = $base_url;
        $var_dir = dirname(__DIR__) . '/../var/';
        $this->mysql_file = $var_dir . \AppBundle\Service\MysqlStatus::FILE_NAME;
        $this->redis_file = $var_dir . \AppBundle\Service\RedisStatus::FILE_NAME;
        $this->client      = new \GuzzleHttp\Client();
    }

    /**
     * @BeforeScenario
     */
    public function setup()
    {
        if (file_exists($this->redis_file)) {
            unlink($this->redis_file);
        }
        if (file_exists($this->mysql_file)) {
            unlink($this->mysql_file);
        }
    }

    /**
     * @When I go to :url_arg
     * @param $url_arg
     */
    public function iGoTo($url_arg)
    {
        $res = $this->client->get($this->base_url.$url_arg);
        $this->response = json_decode($res->getBody()->__toString());
    }

    /**
     * @Given there is :service, which is :status
     * @param $service
     * @param $status
     */
    public function thereIsWhichIs($service, $status)
    {
        if ($status != self::WORKING) {
            return;
        }
        switch ($service) {
            case "Mysql" :
                touch($this->mysql_file);
                break;
            case "Redis" :
                touch($this->redis_file);
                break;
        }
    }

    /**
     * @Then :service status is :status
     * @param $service
     * @param $status
     * @return bool
     * @throws Exception
     */
    public function serviceStatusIs($service, $status)
    {
        $service = strtoupper($service);
        if (! is_object($this->response) || !isset($this->response->$service)) {
            throw new Exception($service . " status not in response");
        }
        if ($status == self::WORKING) {
            if ($this->response->$service !== true) {
                throw new Exception($service . " expected to be working, but is not working : ".$this->response->$service);
            }
        } else {
            if ($this->response->$service === true) {
                throw new Exception($service . " expected to be not working, but it is working");
            }
        }
        return false;
    }
}
