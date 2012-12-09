<?php
namespace Tzander\Tests;

use Tzander\PageFactory\Handler\LocatingElementHandler;
use Tzander\PageFactory\DefaultElementLocator;

class LocatingElementHandlerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Tzander\PageFactory\Handler\ LocatingElementHandler
     */
    private $handler;

    public function setUp()
    {
        $this->handler = new LocatingElementHandler($this->getMockLocator());
    }

    /**
     * @return \Tzander\PageFactory\DefaultElementLocator
     */
    private function getMockLocator()
    {
        $url = new \PHPUnit_Extensions_Selenium2TestCase_URL("http://localhost");
        $driver = $this->getMock("PHPUnit_Extensions_Selenium2TestCase_Driver", array(), array($url));

        $element = $this->getMock("PHPUnit_Extensions_Selenium2TestCase_Element", array(), array($driver, $url));

        $testCase = $this->getMock("PHPUnit_Extensions_Selenium2TestCase");

        $property = $this->getMock("ReflectionProperty", array(), array("PageTestClass", 'link'));
        $locator = $this->getMock(
            "Tzander\PageFactory\DefaultElementLocator",
            array("findElement"),
            array($testCase, $property)
        );
        $locator->expects($this->any())
            ->method("findElement")
            ->will($this->returnValue($element));

        return $locator;
    }

    /**
     * @test
     */
    public function shouldLocateElement()
    {
        $element = $this->handler->invoke();
        $this->assertInstanceOf("PHPUnit_Extensions_Selenium2TestCase_Element", $element);
    }
}
