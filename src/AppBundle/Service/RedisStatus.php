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
     * MysqlStatus constructor.
     * @param \AppKernel $kernel
     */
    public function __construct(\AppKernel $kernel)
    {
        $this->root_dir = $kernel->getRootDir() . '/../var/';
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return file_exists($this->root_dir . self::FILE_NAME);
    }
}