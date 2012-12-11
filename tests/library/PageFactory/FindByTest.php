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
     * @expectedException InvalidArgumentException
     */
    public function invalidMethod(){
        $find = new FindBy("ByName='test'");
        $this->assertEquals("byName", $find->getFindMethod());
    }
}
