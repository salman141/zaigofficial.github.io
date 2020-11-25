<?php
/**
 * (Just) Theme update notification.
 *
 * This code only enables WordPress native theme update notification but
 * it does not allow theme auto-update functionality.
 * The theme still needs to be updated manually via FTP! Or use a plugin
 * such as Envato Market for automatic theme updates in case the theme was
 * obtained from ThemeForest.net.
 *
 * Data are being cached in transient as they are global for the website.
 *
 * @subpackage  Updates
 * @subpackage  Admin
 *
 * @package    Icelander
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.3.0
 * @version  1.5.5
 */
class Icelander_Update_Notification {

	/**
	 * Theme slug.
	 *
	 * @since   1.3.0
	 * @access  private
	 * @var     string
	 */
	private static $theme = 'icelander';

	/**
	 * Name of cached data transient.
	 *
	 * @since   1.5.5
	 * @access  private
	 * @var     string
	 */
	private static $transient_cache_name = 'icelander_update_data';

	/**
	 * Time until cache transient expires, in seconds. (Time To Live)
	 *
	 * @since   1.5.5
	 * @access  private
	 * @var     string
	 */
	private static $transient_cache_ttl = 7 * 24 * 60 * 60;

	/**
	 * URL where to check for update data.
	 *
	 * @since    1.3.0
	 * @version  1.5.5
	 * @access   private
	 * @var      string
	 */
	private static $remote_url = 'https://raw.githubusercontent.com/webmandesign/updates/master/themes/versions.json';

	/**
	 * Soft cached retrieved remote data.
	 *
	 * @since   1.5.5
	 * @access  private
	 * @var     string
	 */
	private static $remote_data = null;

	/**
	 * Initialization.
	 *
	 * @since  1.5.5
	 *
	 * @return  void
	 */
	public static function init() {

		// Requirements check

			if ( ! current_user_can( 'update_themes' ) ) {
				return;
			}


		// Processing

			// Filters

				add_filter( 'site_transient_' . 'update_themes', __CLASS__ . '::set' );

	} // /init

	/**
	 * Enable theme update notification when needed.
	 *
	 * Should be hooked onto `site_transient_update_themes`.
	 *
	 * @since    1.3.0
	 * @version  1.5.5
	 *
	 * @param  $data  Transient value.
	 *
	 * @return  object
	 */
	public static function set( $data ) {

		// Variables

			$current_version = self::get_update_data();


		// Processing

			if (
				isset( $data->checked[ self::$theme ] )
				&& ! empty( $current_version )
				&& version_compare( ICELANDER_THEME_VERSION, $current_version, '<' )
			) {

				// WordPress update data structure.
				$data->response[ self::$theme ] = array(
					'theme'       => self::$theme,
					'new_version' => esc_attr( $current_version ),
					'url'         => 'https://webmandesign.github.io/docs/icelander/#update',
					'package'     => false,
				);

				// Tell WordPress, there is a new theme update.
				set_site_transient( 'update_themes', $data );

				// Flush the transient cache.
				delete_transient( self::$transient_cache_name );

				// We don't have to run this again.
				remove_filter( current_filter(), __METHOD__ );

			}


		// Output

			return $data;

	} // /set

	/**
	 * Get remote server theme update JSON data.
	 *
	 * @since    1.3.0
	 * @version  1.5.5
	 *
	 * @return  mixed  Cache transient value or array of data.
	 */
	private static function get_update_data() {

		// Variables

			// Get cached data from transient first.
			$data = get_transient( self::$transient_cache_name );


		// Processing

			if ( empty( $data ) ) {

				// This can be overrode with remote data.
				$ttl = self::$transient_cache_ttl;

				// Make sure to call remote server just once.
				if ( null === self::$remote_data ) {
					self::$remote_data = wp_remote_get( self::$remote_url );
				}

				if (
					! is_wp_error( self::$remote_data )
					&& isset( self::$remote_data['body'] )
				) {
					$data_remote = json_decode( self::$remote_data['body'], true );

					// Controlling TTL with remote data.
					if ( isset( $data_remote['ttl'] ) ) {
						$ttl = $data_remote['ttl'];
					}

					// If the theme data exist, pull them out.
					if ( isset( $data_remote[ self::$theme ] ) ) {
						$data = $data_remote[ self::$theme ];
					}
				}

				// If no data received, set a dummy one to prevent remote data check before TTL.
				if ( empty( $data ) ) {
					$data = '0.0.0';
				}

				// Cache the data in transient.
				set_transient( self::$transient_cache_name, $data, $ttl );
			}


		// Output

			return $data;

	} // /get_update_data

}

Icelander_Update_Notification::init();
