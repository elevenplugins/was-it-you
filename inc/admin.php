<?php
/**
 * This class handles the admin pages.
 */

namespace E11_WasitYou;

/**
 * Class Admin
 *
 * @package E11_WasitYou
 */
class Admin {

	/**
	 * Admin constructor.
	 */
	public function __construct() {
		$this->hooks();
	}

	/**
	 * Hooks for the admin side.
	 */
	private function hooks() {
		add_action( 'admin_menu', [ $this, 'add_menu_pages' ] );
	}

	/**
	 * Add the menu pages for the admin options.
	 */
	public function add_menu_pages() {

		add_options_page(
			esc_html__( 'Was it you?', 'was-it-you' ),
			esc_html__( 'Was it you?', 'was-it-you' ),
			'manage_options',
			'was-it-you',
			[ $this, 'settings_page_render' ]
		);
	}

	/**
	 * Render the settings page.
	 */
	public function settings_page_render() {

		// Load settings form here.
	}
}

new \E11_WasitYou\Admin();
