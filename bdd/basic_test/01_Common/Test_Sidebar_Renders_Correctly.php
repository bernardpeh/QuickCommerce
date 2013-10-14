<?php

require_once(dirname(__FILE__) . '/../../config.php');


class ElementsTest extends PHPUnit_Framework_TestCase {
  public static $config;

  static function setUpBeforeClass() {
    self::$config = new BCG_Config;
    self::$config->session->open(self::$config->installed_domain);
  }

  static function tearDownAfterClass() {
    self::$config->session->close();
  }
  
  public function setUp() {
  }
  
  public function tearDown() {
  }
 
  function test_GIVEN_homepage_WHEN_i_see_the_right_sidebar_THEN_i_should_see_the_word_Product_Search() {
    $s = self::$config->session->element('xpath', '//aside[@class="widget woocommerce widget_product_search"]/h3');
    $this->assertEquals($s->text(), 'PRODUCT SEARCH');
  }
  
  function test_GIVEN_homepage_WHEN_i_see_the_right_sidebar_THEN_i_should_see_the_word_Product_Categories() {
    $s = self::$config->session->element('xpath', '//aside[@class="widget woocommerce widget_product_categories"]/h3');
    $this->assertEquals($s->text(), 'PRODUCT CATEGORIES');
  }
}
?>
