<?php
namespace Tzander\PageFactory;

use Tzander\PageFactory\Handler\LocatingElementHandler;

class DefaultFieldDecorator implements FieldDecorator
{

    /**
     * @param ElementLocatorFactory $factory
     */
    public function __construct(ElementLocatorFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param \ReflectionProperty $property
     * @return \PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function decorate(\ReflectionProperty $property)
    {
        $locator = $this->factory->createLocator($property);
        $handler = new LocatingElementHandler($locator);
        return $handler->invoke();
    }
}
