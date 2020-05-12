<?php
/**
 * Plugin Name: Was it you?
 * Version: 1.0.0
 * Plugin URI: https://eleven.io/was-it-you
 * Description: Was it you? is a plugin that sends you an email if you logged in from a new IP.
 * Author: Eleven Plugins
 * Author URI: https://eleven.io/
 *
 * @package E11_WasitYou
 *
 */

/**
 * Class E11_Was_It_You. Main class used to initialize the plugin.
 */
class E11_Was_It_You {

	/**
	 * The current plugin version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * E11_Was_It_You constructor.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialize the plugin.
	 */
	public function init() {
		$this->includes();
	}

	/**
	 * Include the main sections.
	 */
	public function includes() {

		include_once 'inc/WasItYou.php';

	}
}

new E11_Was_It_You();
