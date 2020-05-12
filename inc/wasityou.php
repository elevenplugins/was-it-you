<?php
/**
 * Entry point for namespace.
 *
 * @package E11_WasitYou
 */

namespace E11_WasitYou {

	/**
	 * Class WasItYou
	 *
	 * @package E11_WasitYou
	 */
	final class WasItYou {

		/**
		 * The instance.
		 *
		 * @since 1.0.0
		 *
		 * @var \E11_WasitYou\WasItYou
		 */
		private static $instance;

		/**
		 * Main Instance.
		 *
		 * @since 1.0.1
		 *
		 * @return WasItYou
		 */
		public static function instance() {

			if (
				null === self::$instance ||
				! self::$instance instanceof self
			) {

				self::$instance = new self();
				self::$instance->includes();
			}

			return self::$instance;
		}
		/**
		 * Include files.
		 *
		 * @since 1.0.1
		 */
		private function includes() {

			include_once 'login.php';
			include_once 'user.php';
		}
	}

	WasItYou::instance();
}
