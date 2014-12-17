<?php
/**
 * Plugin Name: Qobo Custom Theme Path
 * Plugin URI:  https://github.com/QoboLtd/Qobo-WP-Custom-Theme-Path 
 * Description: Registers the a custom theme path for better theme organization.
 * Version: 1.0.1
 * Author: Andreas Demetriou
 * License: GPL2
 */

// Allow to change this in wp-config.php or elsewhere
if (!defined('QB_CUSTOM_THEME_PATH')) {
	define('QB_CUSTOM_THEME_PATH', '../custom-themes');
}

$qoboCustomThemePath = ABSPATH . QB_CUSTOM_THEME_PATH;

// Register custom-theme path for "on the fly"
register_theme_directory($qoboCustomThemePath);

// Check if the option is preserved for later too
if (get_option('stylesheet_root') <> $qoboCustomThemePath) {
	update_option('stylesheet_root', $qoboCustomThemePath);
}

// No need for variable anymore
unset($qoboCustomThemePath);
