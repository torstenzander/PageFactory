<?php
namespace Tzander\Tests;

use Tzander\PageFactory\Annotations;
use Tzander\PageFactory\ReflectionProperty;

class AnnotationsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Tzander\PageFactory\Annotations
     */
    private $annotation;

    /**
     * @var string
     * @find byName="test"
     */
    public $testProperty;

    public $propertyWithNoMethod;

    public function setUp()
    {
    }

    /**
     * @test
     */
    public function getFindByMethod()
    {
        $property = new ReflectionProperty($this, "testProperty");
        $annotation = new Annotations($property);
        $method = $annotation->buildBy();
        $this->assertEquals('byName', $method);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function catchException()
    {
        $property = new ReflectionProperty($this, "propertyWithNoMethod");
        $annotation = new Annotations($property);
        $annotation->buildBy();
    }
}
