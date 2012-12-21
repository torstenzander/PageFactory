<?php
namespace Tzander\Tests;

require_once dirname(__FILE__) . "/../fixtures/PageTestClass.php";

use Tzander\PageFactory\ReflectionProperty;

class ReflectionPropertyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Tzander\PageFactory\ReflectionProperty
     */
    private $reflection;

    /**
     * @find byXpath='a[@class=test]'
     */
    public $testProperty;

    public function setUp()
    {
        $reflection = new \ReflectionProperty(new \PageTestClass, 'link');
        $this->reflection = new ReflectionProperty($reflection);
    }

    /**
     * @test
     */
    public function shouldGetAnnotation()
    {
        $findBy = $this->reflection->getFindAnnotation();
        $this->assertInstanceOf('\Tzander\FindBy', $findBy);
    }

    /**
     * @test
     */
    public function shouldGetNoValue()
    {
        $reflection = new \ReflectionProperty(new \PageTestClass, 'nolink');
        $pageFactoryReflection = new ReflectionProperty($reflection);
        $value = $pageFactoryReflection->getFindAnnotation();
        $this->assertNull($value);
    }

    /**
     * @test
     */
    public function testXpathSyntax()
    {
        $reflection = new \ReflectionProperty(new \PageTestClass, 'link');
        $pageFactoryReflection = new ReflectionProperty($reflection);
        $value = $pageFactoryReflection->getFindAnnotation();
        $this->assertInstanceOf('\Tzander\FindBy', $value);
    }


}
