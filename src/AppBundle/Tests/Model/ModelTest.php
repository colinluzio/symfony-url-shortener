<?php
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//
//class MyModelTest extends WebTestCase
//{
//    /**
//     * @var EntityManager
//     */
//    private $_em;
//
//    protected function setUp()
//    {
//        $kernel = static::createKernel();
//        $kernel->boot();
//        $this->_em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
//        $this->_em->beginTransaction();
//    }
//
//    /**
//     * Rollback changes.
//     */
//    public function tearDown()
//    {
//        $this->_em->rollback();
//    }
//
//    public function testRepository()
//    {
//        $url = $this->_em->getRepository('AppBundle:Url')->find(1);
//    }
//}
