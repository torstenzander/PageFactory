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
interface ElementLocatorFactory
{
    public function createLocator(\Tzander\PageFactory\ReflectionProperty $property);
}
