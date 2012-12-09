<?php
namespace Tzander;

use Tzander\PageFactory\DefaultElementLocatorFactory;
use Tzander\PageFactory\DefaultFieldDecorator;

class PageFactory
{

    public static function initElements(\PHPUnit_Extensions_Selenium2TestCase $testCase, $pageClassname)
    {
        $page = self::instantiatePage($testCase, $pageClassname);
        self::initElementsWithObject($testCase, $page);
        return $page;
    }

    public static function initElementsWithObject(\PHPUnit_Extensions_Selenium2TestCase $testCase, $page)
    {
        self::initElementsWithLocatorFactory(new DefaultElementLocatorFactory($testCase), $page);
    }

    public static function initElementsWithLocatorFactory(\Tzander\PageFactory\ElementLocatorFactory $factory, $page)
    {
        self::initElementsWithDecorator(new DefaultFieldDecorator($factory), $page);
    }

    public static function initElementsWithDecorator(\Tzander\PageFactory\FieldDecorator $decorator, $page)
    {
        self::proxyFields($decorator, $page);
    }

    private static function proxyFields(FieldDecorator $decorator, $page)
    {
       $properties = new ReflectionProperty($page);
    }

    private static function instantiatePage(\PHPUnit_Extensions_Selenium2TestCase $testCase, $pageClassname)
    {
        try {
            $page = new $pageClassname();
            return $page;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
