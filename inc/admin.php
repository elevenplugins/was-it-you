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

		add_action( 'admin_init', [ $this, 'maybe_save_settings' ] );
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
		// TODO: move this to a template file.
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Was it you? - Settings', 'was-it-you' ); ?></h1>
			<form name="form" action="" method="post">
				<table class="form-table" role="presentation">
					<tbody>
					<tr>
						<th scope="row">
							<label for="ips_to_save">
								<?php esc_html_e( 'Number of IPs to save', 'was-it-you' ); ?>
							</label>
						</th>
						<td>
							<input name="ips_to_save" type="number" step="1" min="0" id="ips_to_save" value="<?php echo absint( Settings::instance()->get_option( 'ips_to_save', 0 ) ); ?>" class="small-text">
							<?php esc_html_e( 'IPs', 'was-it-you' ); ?>
							<p class="description">
								<?php esc_html_e( '0 means all IPs are saved, 1 saves just the current one.', 'was-it-you' ); ?>
							</p>
						</td>
					</tr>
					</tbody>
				</table>
				<?php wp_nonce_field( 'e11-was-it-you-save', '_e11_nonce' ); ?>
				<p class="submit">
					<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'was-it-you' ); ?>">
				</p>
			</form>
		</div>
		<?php
	}

	/**
	 * Check if the settings nonce is present and save options.
	 */
	public function maybe_save_settings() {

		if ( ! empty( $_POST['_e11_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_e11_nonce'] ) ), 'e11-was-it-you-save' ) ) {

			if ( isset( $_POST['ips_to_save'] ) ) {
				Settings::instance()->update_option( 'ips_to_save', absint( wp_unslash( $_POST['ips_to_save'] ) ) );
			}
		}

	}
}

new Admin();
