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

    /**
     * @test
     */
    public function getFindMethod()
    {
        $property = new \ReflectionProperty($this, "testProperty");
        $property = new ReflectionProperty($property);
        $annotation = new Annotations($property);
        $findBy = $annotation->buildBy();
        $this->assertEquals('byName', $findBy->getFindMethod());
    }

    /**
     * @test
     */
    public function getFindArgument()
    {
        $property = new \ReflectionProperty($this, "testProperty");
        $property = new ReflectionProperty($property);
        $annotation = new Annotations($property);
        $findBy = $annotation->buildBy();
        $this->assertEquals('test', $findBy->getArguments());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function catchException()
    {
        $property = new \ReflectionProperty($this, "propertyWithNoMethod");
        $property = new ReflectionProperty($property);
        $annotation = new Annotations($property);
        $annotation->buildBy();
    }
}
