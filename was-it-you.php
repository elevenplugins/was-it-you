<?php
/**
 * Plugin Name: Was it you? Account login notifications
 * Version: 1.0.1
 * Plugin URI: https://elevenplugins.com/
 * Description: Was it you? is a plugin that sends you an email if you logged in from a new IP.
 * Author: gripgrip, bogdand, Eleven Plugins
 * Author URI: https://elevenplugins.com/
 * License: GPL2
 *
 * "Was it you?" is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * "Was it you?" is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with "Was it you?". If not, see https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html.
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
		$this->define_constants();
		$this->init();
	}

	/**
	 * Define plugin-specific constants.
	 */
	public function define_constants() {

		if ( ! defined( 'E11_WAS_IT_YOU_PLUGIN_FILE' ) ) {
			define( 'E11_WAS_IT_YOU_PLUGIN_FILE', __FILE__ );
		}

		if ( ! defined( 'E11_WAS_IT_YOU_PLUGIN_DIR' ) ) {
			define( 'E11_WAS_IT_YOU_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		if ( ! defined( 'E11_WAS_IT_YOU_PLUGIN_URL' ) ) {
			define( 'E11_WAS_IT_YOU_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}
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
