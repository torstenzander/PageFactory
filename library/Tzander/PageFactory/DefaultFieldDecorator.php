<?php
namespace Tzander\PageFactory;

class DefaultFieldDecorator implements FieldDecorator
{

    public function __construct(ElementLocatorFactory $factory)
    {
        $this->factory = $factory;
    }

    public function decorate()
    {

    }
}
