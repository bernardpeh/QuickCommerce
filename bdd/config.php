<?php
/**
 * main connection params for testing
 *
 * @author  Bernard Peh <[email]>
 * @since  1 Feb 2013
 */

require_once(dirname(__FILE__) . '/php-webdriver/PHPWebDriver/WebDriver.php');
require_once(dirname(__FILE__) . '/php-webdriver/PHPWebDriver/WebDriverWait.php');

class BCG_Config
{

	private $installed_domain = 'http://quickcommerce.dev';
	private $test_email = 'test@localhost.localdomain';
	private $test_username = 'test@localhost.localdoamain';
	private $test_firstname = 'testfirstname';
	private $test_lastname = 'testlastname';
	private $test_password = '12345';
	private $admin_username = 'admin';
	private $admin_password = '12345';
	private $discount_coupon = 'testing99monsteroo';
	private $db_server = 'localhost';
	private $db_username = 'root';
	private $db_passwd = '';
	private $db_name = 'quickcommerce';
	private $db_link;
	private $session;
	private $wait;

	public function __construct() {
		$driver = new PHPWebDriver_WebDriver();
    	$this->session = $driver->session();
    	// set implicit wait of 15 secs
    	$this->session->implicitlyWait(15);
    	$this->wait = new PHPWebDriver_WebDriverWait($this->session);
	} 

	public function __set($var, $val) {
		$this->$var = $val;
	}

	public function __get($var) {
		return $this->$var;
	}

	/**
	 * connect to db
	 * @return null 
	 */
	public function db_connect() {
		$this->db_link = mysql_connect($this->db_server, $this->db_username, $this->db_passwd);
		mysql_select_db($this->db_name, $this->db_link);
	}

	/** custom query
	 * @param  string  $sql    your query string
	 * @param  boolean $return set it to true if you need a return array, for eg a select statement
	 * @return mixed          array or null
	 */
	public function db_query($sql, $return = false) {
		$this->db_connect();
		$res = mysql_query($sql, $this->db_link) or die(mysql_error());
		if ($return) {
			$array = array();
			while ($row = mysql_fetch_array($res)) {
				$array[] = $row;
			}
			return $array;
		}
		return;
	}

	public function admin_login() {
		$this->session->open("$this->installed_domain/wp-login.php");
		$this->session->element('id', 'user_login')->clear();
        $this->session->element('id', 'user_login')->sendKeys($this->admin_username);
        $this->session->element('id', 'user_pass')->clear();
        $this->session->element('id', 'user_pass')->sendKeys($this->admin_password);
        $this->session->element('id', 'wp-submit')->click();
	}

	public function myaccount_login($user='', $passwd='') {
		$user = ($user == '') ? $this->test_username : $user;
		$passwd = ($passwd == '') ? $this->test_password : $passwd;
		$this->session->open($this->installed_domain.'/my-account/');
 		$this->session->element('id', 'my-user-login')->sendKeys($user);
        $this->session->element('id', 'my-user-pass')->sendKeys($passwd);
        $this->session->element('id', 'my-submit')->click();
	}

	public function myaccount_logout() {
		// make sure that you already logged in
		$this->session->open($this->installed_domain.'/my-account/?logout');
	}

	public function delete_user($username) {
		// note that user must be logged in to wp-admin in order for this to work.
		$this->admin_login();
		$this->session->open($this->installed_domain.'/wp-admin/users.php');
        $href = $this->session->element('xpath', '//a[text()="'.$username.'"]/../..//a[text()="Delete"]')->attribute('href');
        $this->session->open($href);
        $this->session->element('id', 'delete_option0')->click();
        $this->session->element('id', 'submit')->click();
        // always logout after deleting user
        $this->myaccount_logout();
	}

	public function populate_billing_form($create_account = 0) {
		$this->session->element('id', 'billing_first_name')->sendKeys($this->test_firstname);
        $this->session->element('id', 'billing_last_name')->sendKeys($this->test_lastname);
        $this->session->element('id', 'billing_email')->sendKeys($this->test_email);
        if ($create_account) {
        	$checked = $this->session->element('id', 'createaccount')->attribute('checked');
        	if ($checked == null) {
        		$this->session->element('id', 'createaccount')->click();
        	}
        	// system now using email as default acct_username
        	// $this->session->element('id', 'account_username')->sendKeys($this->squirrelmail_username);
        	$this->session->element('id', 'account_password')->sendKeys($this->test_password);
        	$this->session->element('id', 'account_password-2')->sendKeys($this->test_password);
        }
	}

}