<?php
/**
 * Created by PhpStorm.
 * User: jeckel
 * Date: 03/05/17
 * Time: 22:23
 */

namespace AppBundle\Service;


interface StatusInterface
{
    /**
     * Return service status
     *
     * @return bool
     */
    public function getStatus(): bool;
}