<?php
/**
 * Created by PhpStorm.
 * User: jeckel
 * Date: 03/05/17
 * Time: 22:26
 */

namespace AppBundle\Service;


class RedisStatus implements StatusInterface
{
    /**
     * Name of file use to check if MySQL is running, file exist = mysql is running
     */
    const FILE_NAME = 'redis.running';

    /**
     * @var string
     */
    protected $root_dir;

    /**
     * RedisStatus constructor.
     * @param string $root_dir
     */
    public function __construct(string $root_dir)
    {
        $this->root_dir = $root_dir . '/../var/';
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return file_exists($this->root_dir . self::FILE_NAME);
    }
}