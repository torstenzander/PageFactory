<?php
namespace Tzander;

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Torsten Zander <info@tzander.de>
 * @author    Torsten Zander <info@tzander.de>
 *
 */

use Tzander\PageFactory\DefaultElementLocatorFactory;
use Tzander\PageFactory\DefaultFieldDecorator;

class PageFactory
{

    /**
     * @param \PHPUnit_Extensions_Selenium2TestCase $testCase
     * @param Object                                $pageClassname
     * @return mixed
     */
    public static function initElements(\PHPUnit_Extensions_Selenium2TestCase $testCase, $pageClassname)
    {
        $page = self::instantiatePage($testCase, $pageClassname);
        self::initElementsWithObject($testCase, $page);
        return $page;
    }

    /**
     * @param \PHPUnit_Extensions_Selenium2TestCase $testCase
     * @param Object                                $page
     */
    public static function initElementsWithObject(\PHPUnit_Extensions_Selenium2TestCase $testCase, $page)
    {
        self::initElementsWithLocatorFactory(new DefaultElementLocatorFactory($testCase), $page);
    }

    /**
     * @param PageFactory\ElementLocatorFactory $factory
     * @param Object                            $page
     */
    public static function initElementsWithLocatorFactory(\Tzander\PageFactory\ElementLocatorFactory $factory, $page)
    {
        self::initElementsWithDecorator(new DefaultFieldDecorator($factory), $page);
    }

    /**
     * @param PageFactory\FieldDecorator $decorator
     * @param Object                     $page
     */
    public static function initElementsWithDecorator(\Tzander\PageFactory\FieldDecorator $decorator, $page)
    {
        self::proxyFields($decorator, $page);
    }

    /**
     * @param PageFactory\FieldDecorator $decorator
     * @param Object                     $page
     */
    private static function proxyFields(\Tzander\PageFactory\FieldDecorator $decorator, $page)
    {
        $reflection = new \ReflectionClass($page);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);
        foreach ($properties as $property) {
            $element = $decorator->decorate($property);
            $property->setAccessible(true);
            $property->setValue($page, $element);
        }
    }

    /**
     * @param \PHPUnit_Extensions_Selenium2TestCase $testCase
     * @param string                                $pageClassname
     * @return mixed
     */
    private static function instantiatePage(\PHPUnit_Extensions_Selenium2TestCase $testCase, $pageClassname)
    {
        $page = new $pageClassname();
        return $page;
    }
}
