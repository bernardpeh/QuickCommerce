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
  
  function test_GIVEN_the_homepage_WHEN_in_header_THEN_i_should_see_the_Woocommerce_Quickstart_Demo_title() {
    $this->assertRegExp("/Woocommerce Quickstart Demo/",self::$config->session->title());
  }

  function test_GIVEN_the_homepage_WHEN_in_top_main_menu_THEN_i_should_see_4_menu_items() {
    $s = self::$config->session->elements('xpath', '//ul[@id="menu-not-logged-in"]/li');
    $this->assertEquals(count($s), 4);
  }

}
?>
