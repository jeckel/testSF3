<?php
/**
 * Created by PhpStorm.
 * User: jeckel
 * Date: 03/05/17
 * Time: 21:59
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class StatusController extends Controller
{
    /**
     * @Route("/status/", name="status")
     */
    public function indexAction(Request $request)
    {
        $redis_status = $this->container->get('redis.status')->getStatus();
        $mysql_status = $this->container->get('mysql.status')->getStatus();

        return new JsonResponse([
            "APP" => $redis_status && $mysql_status,
            "MYSQL" => $mysql_status,
            "REDIS" => $redis_status
        ]);
    }
}