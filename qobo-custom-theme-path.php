<?php
/**
 * Plugin Name: Qobo Custom Themes Path
 * Plugin URI:  https://github.com/QoboLtd/Qobo-WP-Custom-Theme-Path 
 * Description: Registers the a custom themes path for better theme organization.
 * Version: 1.0.0
 * Author: Andreas Demetriou
 * License: GPL2
 */

register_theme_directory( ABSPATH  . '../custom-themes');
