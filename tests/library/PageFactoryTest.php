<?php
namespace Tzander\Tests;

use Tzander\PageFactory;

require_once "fixtures/PageTestClass.php";

class PageFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase
     */
    private $testCase;

    public function setUp()
    {
        $this->testCase = $this->getMock('PHPUnit_Extensions_Selenium2TestCase');
    }

    /**
     * @test
     */
    public function initPageObject()
    {
        $page = PageFactory::initElements($this->testCase, 'PageTestClass');
        $this->assertInstanceOf('PageTestClass', $page);
    }

    /**
     * @test
     */
    public function shouldHavePropertyFromDecorator()
    {
        $url = new \PHPUnit_Extensions_Selenium2TestCase_URL("http://localhost");
        $driver = $this->getMock("PHPUnit_Extensions_Selenium2TestCase_Driver", array(), array($url));
        $element = $this->getMock("PHPUnit_Extensions_Selenium2TestCase_Element", array(), array($driver, $url));

        $elementLocator = $this->getMock(
            "Tzander\PageFactory\DefaultElementLocatorFactory",
            array(),
            array($this->testCase)
        );

        $decorator = $this->getMock(
            "Tzander\PageFactory\DefaultFieldDecorator",
            array("decorate"),
            array($elementLocator)
        );
        $decorator->expects($this->any())
            ->method("decorate")
            ->will($this->returnValue($element));

        $page = new \PageTestClass();
        PageFactory::initElementsWithDecorator($decorator, $page);

        $this->assertInstanceOf('PageTestClass', $page);
        $this->assertInstanceOf('PHPUnit_Extensions_Selenium2TestCase_Element', $page->link);
    }

}
