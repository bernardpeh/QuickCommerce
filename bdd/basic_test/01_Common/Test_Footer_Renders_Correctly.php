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
 
  function test_GIVEN_homepage_WHEN_i_see_the_footer_THEN_i_should_see_Powered_by_WordPress() {
    $s = self::$config->session->element('xpath', '//div[@class="site-info"]/a');
    $this->assertEquals($s->text(), 'Proudly powered by WordPress');
  }
  
}
?>
