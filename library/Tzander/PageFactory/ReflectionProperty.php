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

class ReflectionProperty extends  \ReflectionProperty{

    public function getFindAnnotation($nameOfAnnotation){
       $comment = $this->getDocComment();
        if (preg_match($this->getRegExForFindAnnotation(), $comment, $matches)) {
           return $matches[1];
        }
    }

    private function getRegExForFindAnnotation(){
         return '/@find\s+([a-zA-Z0-9._="\':-\\\\x7f-\xff]+)/';
    }
}
