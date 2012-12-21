<?php
namespace Tzander\PageFactory;

/*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*
* @copyright Torsten Zander <info@tzander.de>
* @author    Torsten Zander <info@tzander.de>
*
*/
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
     * @param \Tzander\PageFactory\ReflectionProperty $property
     * @return \PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function decorate(\Tzander\PageFactory\ReflectionProperty $property)
    {
        $locator = $this->factory->createLocator($property);
        $handler = new LocatingElementHandler($locator);
        return $handler->invoke();
    }
}
