<?php

namespace E11_WasitYou;

/**
 * Class User
 *
 * @package E11_WasitYou
 */
class User {

	/**
	 * User constructor.
	 *
	 * @param \WP_User $user The user object.
	 */
	public function __construct( $user ) {

		$this->set_user( $user );
	}

	/**
	 * The current user object.
	 *
	 * @var \WP_User The current user.
	 */
	private $user;

	/**
	 * The key used to store the history for the current user in the user meta.
	 *
	 * @var string
	 */
	private $user_history_key = 'e11_ip_history';

	/**
	 * The current user history array.
	 *
	 * @var array
	 */
	private $user_history = [];

	/**
	 * Set the current user in this instance.
	 *
	 * @param \WP_User $user The user object.
	 */
	protected function set_user( $user ) {
		$this->user = $user;
	}

	/**
	 * Check if the current ip is new for this user.
	 *
	 * @param string $ip The ip to check in the user history.
	 *
	 * @return bool
	 */
	public function is_ip_new( $ip ) {

		$history = $this->get_user_ip_history();
		if ( in_array( $ip, $history, true ) ) {
			return false;
		}

		return true;
	}


	/**
	 * Get the saved IPs list for the current user.
	 *
	 * @return array
	 */
	public function get_user_ip_history() {

		$user_history = get_user_meta( $this->user->ID, $this->user_history_key, true );

		if ( ! empty( $user_history ) ) {
			$this->user_history = $user_history;
		}

		return $this->user_history;

	}
	/**
	 * Save the current user IP.
	 *
	 * @param string $ip The IP to save to the user history.
	 */
	public function save_user_ip( $ip ) {

		array_unshift( $this->user_history, $ip );

		$limit = Settings::instance()->get_option( 'ips_to_save', 0 );
		if ( $limit > 0 ) {
			$this->user_history = array_slice( $this->user_history, 0, $limit );
		}

		update_user_meta( $this->user->ID, $this->user_history_key, $this->user_history );

	}
}
