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

class FindBy
{
    /**
     * @var string
     */
    private $findBy;

    /**
     * @var string
     */
    private $methodName;

    /**
     * @var array
     */
    private $methodParts;

    /**
     * @var array
     */
    private $validFindBys = array(
        "byId",
        "byName",
        "byXpath",
        "byCssSelector",
        "byClassName",
    );

    /**
     * @param string $findBy
     */
    public function __construct($findBy)
    {
        $this->methodName = $this->stripMethodName($findBy);
        if (!in_array($this->methodName, $this->validFindBys)) {
            throw new \InvalidArgumentException($findBy . 'unknown find method');
        }
        $this->findBy = $findBy;
    }

    /**
     * @return string
     */
    public function getFindMethod()
    {
        return $this->methodName;
    }

    /**
     * @param string $string
     * @return mixed
     */
    private function stripMethodName($string)
    {
        $this->methodParts[0] = substr($string, 0, strpos($string, '='));
        $this->methodParts[1] = substr($string, strpos($string, '=') + 1);
        return $this->methodParts[0];
    }

    /**
     * @return string
     */
    public function getArguments()
    {
        if ('byXpath' !== $this->methodName) {
            return str_replace(array('"', "'"), array("",""), $this->methodParts[1]);
        }
        return $this->methodParts[1];
    }
}
