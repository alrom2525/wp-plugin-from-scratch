<?php
/**
 * @package Plugin-from-scratch
 */
/*
Plugin Name: Plugin from scratch
Plugin URI: https://github.com/alrom2525/wp-plugin-from-scratch
Description: This is a plugin write from scratch with educational purposes, The code is explained by <strong>Alessandro Castellani</strong> in his YouTube channel.
Version: 1.0.0
Requires PHP: 8.0
Author: Alessandro Castellani
Author URI: https://youtu.be/0l7JTie_6jM
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2022 Automattic, Inc.
*/

/*  
 Securing WordPress, the basic is to check the global variable.
 It prevent public user to directly access your .php files through URL. Because if your file contains some I/O operations it can eventually be triggered (by an attacker) and this might cause unexpected behavior.
 So, Using the snippets can prevent access from your files (directly) and ensures that your Theme files will be executed within the WordPress environment only.
*/
defined('ABSPATH') or die('Hey, you can\t access this file, you silly human!');

if ( class_exists('WpPluginFromScratch') ) {
    class WpPluginFromScratch {
        
        function register() {
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue') );
        }

        function activate() {
            require_once plugin_dir_path( __FILE__ ) . 'inc/wp-plugin-from-scratch-activate.php';
            WpPluginFromScratchActivate::activate();
        }

        function deactivate() {
            flush_rewrite_rules();
        }

        protected function create_post_type() {
            add_action( 'init', array( $this, 'custom_post_type' ) );
        }

        function custom_post_type() {
            register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
        }
        
        function enqueue () {
            // enqueue all our scripts
            wp_enqueue_style('mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
            wp_enqueue_script('mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ) );
        }

    }

    $wpPluginFromScratch = new WpPluginFromScratch();
    $wpPluginFromScratch->register();

    // activation
    register_activation_hook( __FILE__, array($wpPluginFromScratch , 'activate'));

    // deactivation 
    require_once plugin_dir_path( __FILE__ ) . 'inc/wp-plugin-from-scratch-deactivate.php';
    register_deactivation_hook( __FILE__, array('WpPluginFromScratchDeactivate' , 'deactivate'));

}