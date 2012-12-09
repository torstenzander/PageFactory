<?php
namespace Tzander\PageFactory;
use Tzander\PageFactory\NoElementFoundException;

class DefaultElementLocator implements ElementLocator
{

    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase
     */
    private $testCase;

    /**
     * @var \ReflectionProperty
     */
    private $property;

    /**
     * @param \PHPUnit_Extensions_Selenium2TestCase $testCase
     * @param \ReflectionProperty                   $property
     */
    public function __construct(\PHPUnit_Extensions_Selenium2TestCase $testCase, \ReflectionProperty $property)
    {
        $this->testCase = $testCase;
        $this->property = $property;
    }

    /**
     * @return \PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function findElement()
    {
        $element = $this->testCase->byId($this->property);
        if (is_null($element)) {
            $element = $this->testCase->byName($this->property);
        }
        return $element;
    }
}
