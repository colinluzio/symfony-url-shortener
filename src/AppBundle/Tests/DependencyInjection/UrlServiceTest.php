<?php
namespace Aws\Symfony\DependencyInjection;

use AppKernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Reference;

class UrlServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    public function setUp()
    {
        $kernel = new AppKernel('test', true);
        $kernel->boot();
        $this->container = $kernel->getContainer();
    }
    /**
     * @test
     */
    public function urlServiceIsAccessible()
    {
        $this->assertTrue($this->container->has('app.url_service'));
    }
}
