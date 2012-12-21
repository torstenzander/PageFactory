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
use Tzander\PageFactory\Annotations;

class DefaultElementLocator implements ElementLocator
{

    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase
     */
    private $testCase;

    /**
     * @var \Tzander\PageFactory\ReflectionProperty
     */
    private $property;

    /**
     * @param \PHPUnit_Extensions_Selenium2TestCase                    $testCase
     * @param Tzander\PageFactory\ReflectionProperty                   $property
     */
    public function __construct(
        \PHPUnit_Extensions_Selenium2TestCase $testCase,
        \Tzander\PageFactory\ReflectionProperty $property
    ) {
        $this->testCase = $testCase;
        $this->property = $property;
    }

    /**
     * @return \PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function findElement()
    {
        $element = null;
        $annotation = new Annotations($this->property);
        if ($annotation->hasFindAnnotation()) {
            $findBy = $annotation->buildBy();
            $methodName = $findBy->getFindMethod();
            $element =  call_user_func(array($this->testCase, $methodName), $findBy->getArguments());
        }
        if (is_null($element)) {
            $element = $this->testCase->byName($this->property);
        }
        if (is_null($element)) {
            $element = $this->testCase->byId($this->property);
        }
        return $element;
    }
}
