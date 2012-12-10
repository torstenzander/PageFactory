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
        $value = $this->reflection->getFindAnnotation("find");
        $this->assertEquals("ByClass='test'", $value);
    }
}
