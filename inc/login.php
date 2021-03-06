<?php

namespace E11_WasitYou;

/**
 * Class Login
 *
 * @package E11_WasitYou
 */
class Login {

	/**
	 * The current user ip.
	 *
	 * @var string
	 */
	private $ip;

	/**
	 * Login constructor.
	 */
	public function __construct() {
		if ( empty( $_SERVER['REMOTE_ADDR'] ) ) {
			// If the IP is not set don't even bother.
			return;
		}
		$this->hooks();
	}

	/**
	 * Adding hooks.
	 */
	public function hooks() {

		add_action( 'wp_login', [ $this, 'maybe_notify_login' ], 10, 2 );

		add_action( 'e11_notify_new_ip', [ $this, 'new_ip_email' ], 10, 2 );
	}

	/**
	 * Check if the current login should be notified.
	 *
	 * @param string   $user_login The user login username.
	 * @param \WP_User $user The current user that just logged in.
	 */
	public function maybe_notify_login( $user_login, $user ) {
		$wiy_user = new User( $user );

		if ( $wiy_user->is_ip_new( $this->get_ip() ) ) {
			$wiy_user->save_user_ip( $this->get_ip() );
			do_action( 'e11_notify_new_ip', $user, $this->get_ip() );
		}
	}

	/**
	 * Get the IP from the server variables and also store it.
	 *
	 * @return string
	 */
	public function get_ip() {
		// Checked the empty again just for phpcs.
		if ( empty( $this->ip ) && ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
			$this->ip = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
		}

		return $this->ip;
	}


	/**
	 * Send a new ip email.
	 *
	 * @param \WP_User $user The user object.
	 * @param string   $ip The IP to add to the list.
	 */
	public function new_ip_email( $user, $ip ) {

		$email_to   = $user->user_email;
		$site_title = get_bloginfo( 'name' );

		// Message body.
		$message_body_text = sprintf( esc_html__( 'We detected a new login from: %1$s - If this was you please ignore this email. If you don\'t recognize the login attempt we recommend you to login and change your password.', 'was-it-you' ), $ip );

		// Set html content-type.
		add_filter( 'wp_mail_content_type', [ $this, 'email_content_type' ], 10 );
		wp_mail( $email_to, 'New login to your account on ' . $site_title, $message_body_text );

		// Reset content-type to avoid conflicts.
		remove_filter( 'wp_mail_content_type', [ $this, 'email_content_type' ] );

	}

	/**
	 * Content type of the sent email.
	 *
	 * @return string Content type
	 */
	public function email_content_type() {
		return 'text/html';
	}

}

new Login();
