<?php
/**
 * PHP5
 *
 * The main plugin file.
 *
 * @package Qobo_Custom_Theme_Path
 */

/**
 * Require plugin files
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'qobo-custom-theme-path.php';

/**
 * Run plugin code
 *
 * This function is called from the plugin file
 * in the parent directory.
 *
 * @return void
 */
function qb_plugin_run() {
	$plugin = new Qobo_Custom_Theme_Path();
	$plugin->register_path();
}

// Run plugin code.
qb_plugin_run();

