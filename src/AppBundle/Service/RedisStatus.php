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
    public function getStatus(): bool
    {
        return true;
    }
}