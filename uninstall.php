<?php
/**
 * Fired when the plugin is deleted from WordPress.
 *
 * Local avatar images remain in the Media Library; only this plugin's user
 * metadata is removed.
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

delete_metadata( 'user', 0, '_dimipress_local_avatar_id', '', true );
delete_metadata( 'user', 0, '_dimipress_avatar_source', '', true );
