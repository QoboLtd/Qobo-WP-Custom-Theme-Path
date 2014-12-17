<?php
/**
 * Plugin Name: Qobo Custom Theme Path
 * Plugin URI:  https://github.com/QoboLtd/Qobo-WP-Custom-Theme-Path 
 * Description: Registers the a custom theme path for better theme organization.
 * Version: 1.0.1
 * Author: Andreas Demetriou
 * License: GPL2
 */

$qoboCustomThemeDirectory = ABSPATH . '../custom-themes';

// Register custom-theme directory for "on the fly"
register_theme_directory($qoboCustomThemeDirectory);

// Check if the option is preserved for later too
if (get_option('stylesheet_root') <> $qoboCustomThemeDirectory) {
	update_option('stylesheet_root', $qoboCustomThemeDirectory);
}

// No need for variable anymore
unset($qoboCustomThemeDirectory);
