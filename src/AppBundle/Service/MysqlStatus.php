<?php
/**
 * Created by PhpStorm.
 * User: jeckel
 * Date: 03/05/17
 * Time: 22:26
 */

namespace AppBundle\Service;


use Doctrine\Bundle\DoctrineBundle\Registry;

class MysqlStatus implements StatusInterface
{
    protected $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return false;
    }
}