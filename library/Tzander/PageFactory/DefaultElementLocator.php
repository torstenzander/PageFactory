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
