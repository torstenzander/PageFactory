PageFactory for PHP
========================================================

Supports the PageObject pattern for PHP with Selenium2

Example
--------

You need to include the Autoload.php and create a page class.


``` php
 require_once __DIR__ . '/library/Autoload.php';

 class BingSearchPage {

    /**
     * @var PHPUnit_Extensions_Selenium2TestCase_Element
     */
     public $sb_form_q;

     public function search() {
         $this->sb_form_q->value('selenium');
         $this->sb_form_q->submit();
         return PageFactory::initElements($this->getTestCase(), 'SearchResultPage');
     }
 }
```
The property must be public and either the name or the id attribute of the element.

Now in order to have an initialized object to return we need to to the following:

``` php
  class  SearchTest{

    public function shouldfindSelenium(){
          $page = PageFactory::initElements($this, 'BingSearchPage');
          $resultPage = $page->search();
          $this->assertInstanceOf('SearchResultPage', $resultPage);
    }
  }
```

Using Annotation
--------

You can also use the @find annotations in order to locate the element.
``` php
  /**
  * @find byXpath='a[@class=test]'
  */
  public $link;
```

Or any of these find methods:

byId, byName, byXpath, byCssSelector ,byClassName.

