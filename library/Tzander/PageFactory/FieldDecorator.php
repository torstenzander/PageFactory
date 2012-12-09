<?php
namespace Tzander\PageFactory;

interface FieldDecorator
{
    public function decorate(\ReflectionProperty $property);
}
