<?php
/**
 * IndexControllerTest
 */
namespace Application\Controller;

use Application\Controller\IndexController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use \PHPUnit_Framework_TestCase;

/**
 * @link http://framework.zend.com/manual/2.0/en/user-guide/unit-testing.html ZF2 Docs
 */
class IndexControllerTest extends PHPUnit_Framework_TestCase
{
    // the Controller
    protected $controller;
    // the Request instance
    protected $request;
    // the Response
    protected $response;
    // ??
    protected $routeMatch;
    // Event
    protected $event;

    protected function setUp()
    {
        $bootstrap = \Zend\Mvc\Application::init(include 'config/application.config.php');
        $this->controller = new IndexController();
        $this->request = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        $this->event = $bootstrap->getMvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setEventManager($bootstrap->getEventManager());
        $this->controller->setServiceLocator($bootstrap->getServiceManager());
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'index');

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }

}