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
		 * @return WasItYou
		 * @since 1.0.1
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
			require_once E11_WAS_IT_YOU_PLUGIN_DIR . '/inc/login.php';
			require_once E11_WAS_IT_YOU_PLUGIN_DIR . '/inc/user.php';
			require_once E11_WAS_IT_YOU_PLUGIN_DIR . '/inc/admin.php';
		}
	}

	WasItYou::instance();
}
