<?php
/**
 * PHP5
 *
 * @package Qobo_Custom_Theme_Path
 */

/**
 * Qobo Custom Theme Path
 */
class Qobo_Custom_Theme_Path {

	/**
	 * Default custom theme path
	 *
	 * @var string $default_path Default value for custom themes path
	 */
	protected $default_path = '../custom-themes';

	/**
	 * Get default path
	 *
	 * Get the default path to custom themes directory.  Can be adjusted
	 * from outside with QB_CUSTOM_THEME_PATH constant, defined, for
	 * example, in wp-config.php.
	 *
	 * @throws RuntimeException If ABSPATH constant is not defined.
	 * @return string
	 */
	public function get_default_path() {
		if ( ! defined( 'ABSPATH' ) ) {
			throw \RuntimeException( 'ABSPATH constant is not defined.  Something is very wrong!' );
		}

		$default_path = $this->default_path;
		// Allow to change this in wp-config.php or elsewhere.
		if ( defined( 'QB_CUSTOM_THEME_PATH' ) ) {
			$default_path = QB_CUSTOM_THEME_PATH;
		}

		$result = ABSPATH . $default_path;

		return $result;
	}

	/**
	 * Validate given path
	 *
	 * @param string $path Path to check.
	 * @return string|null Problem description.
	 */
	public function validate_path( $path ) {
		$result = null;

		$path = (string) $path;

		// Empty values are not valid.
		if ( empty( $path ) ) {
			return 'Empty path is not allowed';
		}

		// Path must not end in slash.
		// As per https://codex.wordpress.org/Function_Reference/register_theme_directory .
		if ( DIRECTORY_SEPARATOR === substr( $path, -1, 1 ) ) {
			return "Path ends in slash [$path]";
		}

		return $result;
	}

	/**
	 * Register custom theme path
	 *
	 * @param string $dir Directory to register (Relative to WP_CONTENT_DIR).
	 * @param bool   $persistent Whether to update WordPress options or not.
	 * @return boolean|WP_Error True on success, false or WP_Error otherwise
	 */
	public function register_path( $dir = null, $persistent = true ) {
		$result = false;

		// Cast parameters to known values.
		$dir = (string) $dir;
		$persistent = (bool) $persistent;

		if ( empty( $dir ) ) {
			$dir = $this->get_default_path();
		}

		$path_fail_reason = $this->validate_path( $dir );
		if ( $path_fail_reason ) {
			return new WP_Error( 'custom_theme_path_invalid', "Custom themes directory is invalid: $path_fail_reason", $dir );
		}

		// Register custom-theme path for "on the fly".
		$result = register_theme_directory( $dir );

		if ( ! $persistent ) {
			return $result;
		}

		// WordPress option is already set.
		if ( get_option( 'stylesheet_root' ) === $dir ) {
			return $result;
		}

		// Update WordPress option if persistence is required.
		//
		// Not returning the result of this operation as it can
		// be confusing - false is returned either on failure or
		// when the option value was the same and wasn't updated.
		update_option( 'stylesheet_root', $dir );
	}
}
