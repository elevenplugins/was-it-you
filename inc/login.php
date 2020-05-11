<?php

class E11_Login {

	private $ip;

	/**
	 * @var WP_User The current user.
	 */
	private $user;

	private $user_history_key = 'e11_ip_history';

	private $user_history = [];

	public function __construct() {

		if ( empty( $_SERVER['REMOTE_ADDR'] ) ) {
			// If the IP is not set don't even bother.
			return;
		}
		$this->hooks();
	}


	public function hooks() {

		add_action( 'wp_login', [ $this, 'maybe_notify_login' ], 10, 2 );

		add_action( 'e11_notify_new_ip', [ $this, 'new_ip_email' ], 10, 2 );
	}

	/**
	 * @param string  $user_login
	 * @param WP_User $user
	 */
	public function maybe_notify_login( $user_login, $user ) {
		$this->set_user( $user );

		if ( $this->is_ip_new() ) {
			$this->save_user_ip();
			do_action( 'e11_notify_new_ip', $user, $this->get_ip() );
		}
	}

	public function is_ip_new() {

		$history = $this->get_user_ip_history();
		if ( in_array( $this->get_ip(), $history, true ) ) {
			return false;
		}

		return true;
	}

	public function get_ip() {
		// Checked the empty again just for phpcs.
		if ( empty( $this->ip ) && ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
			$this->ip = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
		}

		return $this->ip;
	}

	/**
	 * @param WP_User|int $user
	 */
	public function get_user_ip_history() {

		$user_history = get_user_meta( $this->user->ID, $this->user_history_key, true );

		if ( ! empty( $user_history ) ) {
			$this->user_history = $user_history;
		}

		return $this->user_history;

	}

	public function save_user_ip() {

		array_unshift( $this->user_history, $this->get_ip() );

		update_user_meta( $this->user->ID, $this->user_history_key, $this->user_history );

	}

	protected function set_user( $user ) {
		$this->user = $user;
	}

	/**
	 * @param WP_User $user
	 * @param string $ip
	 */
	public function new_ip_email( $user, $ip ) {

		$email_to = $user->user_email;
		$site_title = get_bloginfo( 'name' );

		wp_mail( $email_to, 'New login to your account on ' . $site_title, 'We detected a new login from: ' . $ip . ' - If this was you please ignore this email.' );

	}

}
