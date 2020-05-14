<?php
/**
 * Class that handles settings storage and retrieval.
 */

namespace E11_WasitYou;

/**
 * Class Settings
 *
 * @package E11_WasitYou
 */
class Settings {

	/**
	 * The instance.
	 *
	 * @since 1.0.0
	 *
	 * @var \E11_WasitYou\Settings
	 */
	private static $instance;

	/**
	 * The options stored in the db.
	 *
	 * @var array
	 */
	private $options;

	/**
	 * Key used for storing settings in the db.
	 *
	 * @var string
	 */
	private $options_key = 'e11_wiy_options';

	/**
	 * Settings constructor.
	 */
	public function __construct() {
		$this->options = get_option( $this->options_key, $this->get_defaults() );
	}

	/**
	 * The default options.
	 *
	 * @return array
	 */
	public function get_defaults() {
		return [
			'ips_to_save' => 0,
		];
	}

	/**
	 * Main Instance.
	 *
	 * @return Settings
	 * @since 1.0.1
	 */
	public static function instance() {

		if (
			null === self::$instance ||
			! self::$instance instanceof self
		) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Grab setting from our plugin object stored in the db.
	 *
	 * @param string $option The option to grab.
	 * @param mixed  $default The default value to return if the option does not exist yet.
	 *
	 * @return bool|mixed
	 */
	public function get_option( $option = '', $default = false ) {

		$option = trim( $option );
		if ( empty( $option ) ) {
			return false;
		}

		if ( ! empty( $this->options[ $option ] ) ) {
			return maybe_unserialize( $this->options[ $option ] );
		}

		return $default;
	}

	/**
	 * Update the options object and persist to the db.
	 *
	 * @param string $option The name of the option to grab.
	 * @param mixed  $value The value to store.
	 */
	public function update_option( $option, $value ) {

		$this->options[ $option ] = $value;

		update_option( $this->options_key, $this->options );

	}

}
