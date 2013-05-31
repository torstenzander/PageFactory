<?php
namespace Tzander\Tests;

use Tzander\FindBy;
class FindByTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function findByName()
    {
        $find = new FindBy("byName='test'");
        $this->assertEquals("byName", $find->getFindMethod());
    }

    /**
     * @test
     */
    public function getArguments()
    {
        $find = new FindBy("byName='test'");
        $this->assertEquals("test", $find->getArguments());
    }
    
    /**
     * @test
     */
    public function getArgumentsXpath()
    {
        $find = new FindBy("byXpath=//div[@id='element_name-test']/form[0]/label[2]");
        $this->assertEquals("//div[@id='element_name-test']/form[0]/label[2]", $find->getArguments());
    }    
    
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function invalidMethod(){
        $find = new FindBy("ByName='test'");
        $this->assertEquals("byName", $find->getFindMethod());
    }
}
