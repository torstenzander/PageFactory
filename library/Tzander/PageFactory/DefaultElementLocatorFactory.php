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
use Tzander\PageFactory\ElementLocatorFactory;

class DefaultElementLocatorFactory implements ElementLocatorFactory
{
    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase
     */
    private $testCase;

    /**
     * @param \PHPUnit_Extensions_Selenium2TestCase $testCase
     */
    public function __construct(\PHPUnit_Extensions_Selenium2TestCase $testCase)
    {
        $this->testCase = $testCase;
    }

    /**
     * @param \ReflectionProperty $property
     * @return DefaultElementLocator
     */
    public function createLocator(\ReflectionProperty $property)
    {
        return new DefaultElementLocator($this->testCase, $property);
    }
}
