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

use Tzander\FindBy;

class ReflectionProperty extends \ReflectionProperty
{
    /**
     * @return null|\Tzander\FindBy
     */
    public function getFindAnnotation()
    {
        $comment = $this->getDocComment();
        if (preg_match($this->getRegExForFindAnnotation(), $comment, $matches)) {
            return new FindBy($matches[1]);
        }
        return null;
    }

    /**
     * @return string
     */
    private function getRegExForFindAnnotation()
    {
        return '/@find\s+([a-zA-Z0-9._()=@"\':-\\\\x7f-\xff]+)/';
    }
}
