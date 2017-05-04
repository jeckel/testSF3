<?php
/**
 * Created by PhpStorm.
 * User: jeckel
 * Date: 03/05/17
 * Time: 22:43
 */

namespace tests\AppBundle\Controller;

use AppBundle\Controller\StatusController;
use AppBundle\Service\StatusInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;

class StatusControllerUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider statusDataProvider
     */
    public function testIndex($mysql_status, $redis_status, $expected)
    {
        $controller = new StatusController();

        $mysqlService = $this->createMock(StatusInterface::class);
        $mysqlService->expects($this->once())
            ->method('getStatus')
            ->willReturn($mysql_status);
        $redisService = $this->createMock(StatusInterface::class);
        $redisService->expects($this->once())
            ->method('getStatus')
            ->willReturn($redis_status);

        $container = $this->createMock(Container::class);
//        $container->method('get')
//            ->will($this->returnValueMap([
//                ['mysql.status', $mysqlService],
//                ['redis.status', $redisService]
//            ]));
        $container->expects($this->at(0))->method('get')->with('redis.status')->willReturn($redisService);
        $container->expects($this->at(1))->method('get')->with('mysql.status')->willReturn($mysqlService);

        $controller->setContainer($container);
        $request = $this->createMock(Request::class);
        $this->assertEquals($expected, $controller->indexAction($request)->getContent());
    }

    public function statusDataProvider()
    {
        return [
            [true, true, '{"APP":true,"MYSQL":true,"REDIS":true}'],
            [true, false, '{"APP":false,"MYSQL":true,"REDIS":false}'],
            [false, true, '{"APP":false,"MYSQL":false,"REDIS":true}'],
            [false, false, '{"APP":false,"MYSQL":false,"REDIS":false}']
        ];
    }
}
