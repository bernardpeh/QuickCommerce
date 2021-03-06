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
 
  function test_GIVEN_homepage_WHEN_i_see_the_content_area_THEN_i_should_see_the_word_Hello_world() {
    $s = self::$config->session->element('xpath', '//div[@id="content"]//h1//a');
    $this->assertRegExp('/Hello world/', $s->text());
  }
  
}
?>
