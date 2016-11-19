<?php
/**
 * Qobo Custom Theme Path Test
 */
class Qobo_Custom_Theme_Path_Test extends WP_UnitTestCase {

	function test_get_default_path() {
		$plugin = new Qobo_Custom_Theme_Path();
		$result = $plugin->get_default_path();
		$this->assertRegExp('/custom-themes/', $result);
	}

	function test_validate_path() {
		$plugin = new Qobo_Custom_Theme_Path();

		$result = $plugin->validate_path(null);
		$this->assertFalse(empty($result), "Empty path validation failed");

		$result = $plugin->validate_path('end/with/slash/');
		$this->assertFalse(empty($result), "End with slash validation failed");

		$result = $plugin->validate_path('some/dir');
		$this->assertTrue(empty($result), "Validation failed for valid path: $result");
	}

	function test_register_path() {
		if (!defined('ABSPATH')) {
			$this->markTestSkipped("ABSPATH constant is not defined.");
		}

		$plugin = new Qobo_Custom_Theme_Path();
		$expected = $plugin->get_default_path();

		// Default path, not persistent
		$result = $plugin->register_path(null, false);
		$result = get_option( 'stylesheet_root' );
		$this->assertEquals($expected, $result, "stylesheet_root option was not updated");

		// Default path, persistent
		$result = $plugin->register_path();
		$result = get_option( 'stylesheet_root' );
		$this->assertEquals($expected, $result, "stylesheet_root option was not updated");

		// Invalid path
		$result = $plugin->register_path('end/with/slash/');
		$this->assertTrue(is_object($result), "Failed path did not return an object");
		$this->assertTrue(is_a($result, 'WP_Error'), "Failed path did not return an instance of WP_Error");
	}
}
