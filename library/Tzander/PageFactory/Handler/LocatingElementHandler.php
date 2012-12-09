<?php
namespace Tzander\PageFactory\Handler;
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Torsten Zander <info@tzander.de>
 * @author    Torsten Zander <info@tzander.de>
 *
 */
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
