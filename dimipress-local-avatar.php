<?php
/**
 * Plugin Name: DimiPress Local Avatar
 * Description: Lets users choose a local Media Library image as their WordPress profile avatar.
 * Plugin URI: https://dimitrium.org/en/software/dimipress-local-avatar
 * Version: 1.3.1
 * Requires at least: 6.4
 * Requires PHP: 7.4
 * Author: Aleksa Dimitrijević
 * Author URI: https://dimitrium.org/en/dimipedia/aleksa-dimitrijevic/
 * License: AGPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/agpl-3.0.html
 * Text Domain: dimipress-local-avatar
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) || exit;

final class Dimipress_Local_Avatar {
	const VERSION = '1.3.1';
	const META_KEY = '_dimipress_local_avatar_id';
	const SOURCE_META_KEY = '_dimipress_avatar_source';

	public function __construct() {
		add_action( 'personal_options_update', array( $this, 'save_profile_field' ) );
		add_action( 'edit_user_profile_update', array( $this, 'save_profile_field' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_media_picker' ) );
		add_filter( 'pre_get_avatar_data', array( $this, 'local_avatar_data' ), 10, 2 );
		add_filter( 'user_profile_picture_description', array( $this, 'profile_picture_controls' ), 10, 2 );
	}

	public function enqueue_media_picker( $hook ) {
		if ( ! in_array( $hook, array( 'profile.php', 'user-edit.php' ), true ) ) {
			return;
		}
		wp_enqueue_media();
		wp_enqueue_script(
			'dimipress-local-avatar',
			plugin_dir_url( __FILE__ ) . 'assets/profile.js',
			array( 'jquery' ),
			self::VERSION,
			true
		);
		wp_enqueue_style(
			'dimipress-local-avatar',
			plugin_dir_url( __FILE__ ) . 'assets/profile.css',
			array(),
			self::VERSION
		);
		wp_localize_script(
			'dimipress-local-avatar',
			'dimipressLocalAvatar',
			array(
				'title'  => __( 'Choose profile image', 'dimipress-local-avatar' ),
				'button' => __( 'Use as local avatar', 'dimipress-local-avatar' ),
			)
		);
	}

	public function profile_picture_controls( $description, $user ) {
		if ( ! current_user_can( 'edit_user', $user->ID ) ) {
			return $description;
		}
		$attachment_id = (int) get_user_meta( $user->ID, self::META_KEY, true );
		$image_url     = $attachment_id ? wp_get_attachment_image_url( $attachment_id, 'thumbnail' ) : '';
		$source        = $this->avatar_source( $user->ID );
		$gravatar_url  = 'https://www.gravatar.com/avatar/' . md5( strtolower( trim( $user->user_email ) ) ) . '?s=96&d=mp';
		ob_start();
		?>
		</p><div class="dimipress-local-avatar-controls">
			<input type="hidden" id="dimipress_local_avatar_id" name="dimipress_local_avatar_id" value="<?php echo esc_attr( $attachment_id ); ?>">
			<input type="hidden" id="dimipress_avatar_source" name="dimipress_avatar_source" value="<?php echo esc_attr( $source ); ?>">
			<div class="dimipress-local-avatar-options">
				<div class="dimipress-local-avatar-option" data-avatar-source="gravatar">
					<img src="<?php echo esc_url( $gravatar_url ); ?>" alt="" width="96" height="96">
				</div>
				<div class="dimipress-local-avatar-option dimipress-local-avatar-local" data-avatar-source="local">
				<?php if ( $image_url ) : ?>
					<img src="<?php echo esc_url( $image_url ); ?>" alt="" width="96" height="96">
				<?php else : ?>
					<span class="dimipress-local-avatar-empty" aria-hidden="true">+</span>
				<?php endif; ?>
			</div>
			</div>
			<label class="dimipress-local-avatar-switch" for="dimipress_avatar_toggle">
				<span><?php esc_html_e( 'Gravatar', 'dimipress-local-avatar' ); ?></span>
				<input type="checkbox" id="dimipress_avatar_toggle" <?php checked( $source, 'local' ); ?> role="switch">
				<span class="dimipress-local-avatar-slider" aria-hidden="true"></span>
				<span><?php esc_html_e( 'Local', 'dimipress-local-avatar' ); ?></span>
			</label>
			<div class="dimipress-local-avatar-actions">
				<button type="button" class="button dimipress-local-avatar-select"><?php esc_html_e( 'Choose local image', 'dimipress-local-avatar' ); ?></button>
				<button type="button" class="button dimipress-local-avatar-remove" <?php disabled( ! $attachment_id ); ?>><?php esc_html_e( 'Remove saved local image', 'dimipress-local-avatar' ); ?></button>
			</div>
			<p class="description"><?php esc_html_e( 'You can switch back to Gravatar at any time. If no local image is selected, WordPress uses Gravatar normally.', 'dimipress-local-avatar' ); ?></p>
		</div><p class="description">
		<?php
		return ob_get_clean();
	}

	public function save_profile_field( $user_id ) {
		if ( ! current_user_can( 'edit_user', $user_id ) || ! isset( $_POST['dimipress_local_avatar_id'], $_POST['dimipress_avatar_source'] ) ) {
			return;
		}
		$source = sanitize_key( wp_unslash( $_POST['dimipress_avatar_source'] ) );
		if ( ! in_array( $source, array( 'gravatar', 'local' ), true ) ) {
			return;
		}
		$attachment_id = absint( $_POST['dimipress_local_avatar_id'] );
		if ( ! $attachment_id ) {
			delete_user_meta( $user_id, self::META_KEY );
			update_user_meta( $user_id, self::SOURCE_META_KEY, 'gravatar' );
			return;
		}
		if (
			'attachment' !== get_post_type( $attachment_id ) ||
			'trash' === get_post_status( $attachment_id ) ||
			! wp_attachment_is_image( $attachment_id ) ||
			! current_user_can( 'edit_post', $attachment_id )
		) {
			return;
		}
		update_user_meta( $user_id, self::META_KEY, $attachment_id );
		update_user_meta( $user_id, self::SOURCE_META_KEY, $source );
	}

	public function local_avatar_data( $args, $id_or_email ) {
		$user = $this->resolve_user( $id_or_email );
		if ( ! $user ) {
			return $args;
		}
		$attachment_id = (int) get_user_meta( $user->ID, self::META_KEY, true );
		if ( 'local' !== $this->avatar_source( $user->ID ) || ! $attachment_id || ! wp_attachment_is_image( $attachment_id ) ) {
			return $args;
		}
		$size = ! empty( $args['size'] ) ? (int) $args['size'] : 96;
		$url  = wp_get_attachment_image_url( $attachment_id, array( $size, $size ) );
		if ( ! $url ) {
			return $args;
		}
		$args['url']          = $url;
		$args['found_avatar'] = true;
		return $args;
	}

	private function avatar_source( $user_id ) {
		$source = get_user_meta( $user_id, self::SOURCE_META_KEY, true );
		if ( in_array( $source, array( 'gravatar', 'local' ), true ) ) {
			return $source;
		}
		return get_user_meta( $user_id, self::META_KEY, true ) ? 'local' : 'gravatar';
	}

	private function resolve_user( $id_or_email ) {
		if ( $id_or_email instanceof WP_User ) {
			return $id_or_email;
		}
		if ( is_numeric( $id_or_email ) ) {
			return get_user_by( 'id', (int) $id_or_email );
		}
		if ( is_object( $id_or_email ) && ! empty( $id_or_email->user_id ) ) {
			return get_user_by( 'id', (int) $id_or_email->user_id );
		}
		if ( is_object( $id_or_email ) && ! empty( $id_or_email->comment_author_email ) ) {
			return get_user_by( 'email', $id_or_email->comment_author_email );
		}
		if ( is_string( $id_or_email ) && is_email( $id_or_email ) ) {
			return get_user_by( 'email', $id_or_email );
		}
		return false;
	}
}

new Dimipress_Local_Avatar();
