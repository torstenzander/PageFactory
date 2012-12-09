<?php
namespace Tzander\PageFactory\Handler;

class LocatingElementHandler
{

    /**
     * @param \Tzander\PageFactory\ElementLocator $locator
     */
    public function __construct(\Tzander\PageFactory\ElementLocator $locator)
    {
        $this->locator = $locator;
    }

    /**
     * @return \PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function invoke()
    {
        $element = $this->locator->findElement();
        return $element;
    }
}
