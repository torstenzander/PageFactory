<?php
namespace Tzander\PageFactory;
use Tzander\PageFactory\ElementLocatorFactory;

class DefaultElementLocatorFactory implements ElementLocatorFactory
{
    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase
     */
    private $testCase;


    public function __construct(\PHPUnit_Extensions_Selenium2TestCase $testCase)
    {
        $this->testCase = $testCase;
    }

    public function createLocator(ReflectionProperty $field)
    {
        return new DefaultElementLocator($this->testCase, $field);
    }
}
