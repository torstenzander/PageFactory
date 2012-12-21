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
class Annotations
{

    /**
     * @var Tzander\PageFactory\ReflectionProperty
     */
    private $property;

    /**
     * @param ReflectionProperty $property
     */
    public function __construct(ReflectionProperty $property)
    {
        $this->property = $property;
    }

    /**
     * @return null|\Tzander\FindBy
     * @throws \InvalidArgumentException
     */
    public function buildBy()
    {
        $findBy = $this->property->getFindAnnotation();
        if (is_null($findBy)) {
            throw new \InvalidArgumentException("No find method given in annotation @find");
        }
        return $findBy;
    }

    public function hasFindAnnotation()
    {
        if (is_null($this->property->getFindAnnotation())) {
            return false;
        }
        return true;
    }

}
