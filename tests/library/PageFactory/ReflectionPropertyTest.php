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

    public function setUp()
    {
        $this->reflection = new ReflectionProperty(new \PageTestClass, 'link');
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
        $reflection = new ReflectionProperty(new \PageTestClass, 'nolink');
        $value = $reflection->getFindAnnotation();
        $this->assertEquals("", $value);
    }

    //TODO: Test with @ in xpath
}
