<?php
namespace Tzander\Tests;

use Tzander\PageFactory\DefaultElementLocator;

class DefaultElementLocatorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var  Tzander\PageFactory\DefaultElementLocator
     */
    private $locator;

    /**
     * @var  PHPUnit_Extensions_Selenium2TestCase_Element
     */
    private $element;


    public function setUp(){
        $url = new \PHPUnit_Extensions_Selenium2TestCase_URL("http://localhost");
        $driver = $this->getMock("PHPUnit_Extensions_Selenium2TestCase_Driver", array(), array($url));

        $this->element = $this->getMock("PHPUnit_Extensions_Selenium2TestCase_Element", array(), array($driver, $url));


    }

    /**
     * @test
     */
    public function shouldFindElementById(){
        $testCase = $this->getMock("PHPUnit_Extensions_Selenium2TestCase", array("byId", "byName"));
        $testCase->expects($this->any())
            ->method("byId")
            ->will($this->returnValue($this->element));
        $testCase->expects($this->any())
            ->method("byName")
            ->will($this->returnValue(null));

        $property = new \ReflectionProperty(new \PageTestClass(), "link");
        $property = $this->getMock("\Tzander\PageFactory\ReflectionProperty", array(), array($property));

        $this->locator = new DefaultElementLocator($testCase, $property);

        $element = $this->locator->findElement();
        $this->assertInstanceOf("PHPUnit_Extensions_Selenium2TestCase_Element", $element);

    }

    /**
     * @test
     */
    public function shouldFindElementByName(){
        $testCase = $this->getMock("PHPUnit_Extensions_Selenium2TestCase", array("byName","byId"));
        $testCase->expects($this->any())
            ->method("byName")
            ->will($this->returnValue($this->element));

        $testCase->expects($this->any())
            ->method("byClassName")
            ->will($this->returnValue(null));

        $property = new \ReflectionProperty(new \PageTestClass(), "link");
        $property = $this->getMock("\Tzander\PageFactory\ReflectionProperty", array(), array($property));

        $this->locator = new DefaultElementLocator($testCase, $property);

        $element = $this->locator->findElement();
        $this->assertInstanceOf("PHPUnit_Extensions_Selenium2TestCase_Element", $element);
    }

}
