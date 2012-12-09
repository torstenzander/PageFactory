<?php
namespace Tzander\PageFactory;
/**
 * 
 * User: torsten
 * Date: 07.12.12
 * Time: 17:25
 * 
 */
interface ElementLocator {

    public function createLocator(ReflectionProperty $property);
}
