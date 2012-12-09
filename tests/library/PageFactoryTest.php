<?php
namespace Tzander\Tests;

use Tzander\PageFactory;

require_once "fixtures/PageTestClass.php";

class PageFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function initPageObject()
    {
        $testCase = $this->getMock('PHPUnit_Extensions_Selenium2TestCase');
        $page = PageFactory::initElements($testCase, 'PageTestClass');
        $this->assertInstanceOf('PageTestClass', $page);
    }


}
