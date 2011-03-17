<?php
/*
  Plugin Name: s2member EOT Warning
  Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
  Description: Sends a 2 week warning of every EOT
  Version: 0.1
  Author: Christopher Giroir (email : kelsin@valefor.com)
  Author URI: http://blog.kelsin.net/
  License: GPL2

  Copyright 2011 Christopher Giroir (email : kelsin@valefor.com)

  This program is free software; you can redistribute it and/or modify it under
  the terms of the GNU General Public License, version 2, as published by the
  Free Software Foundation.

  This program is distributed in the hope that it will be useful, but WITHOUT
  ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
  FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
  details.

  You should have received a copy of the GNU General Public License along with
  this program; if not, write to the Free Software Foundation, Inc., 51 Franklin
  St, Fifth Floor, Boston, MA 02110-1301 USA
*/

add_action('admin_menu', 's2member_eot_warning_menu');

function s2member_eot_warning_menu() {
  add_submenu_page('ws-plugin--s2member-options', 's2member EOT Warning Options', 'EOT Warning', 'manage_options', 's2member_eot_warning', 's2member_eot_warning_options_page');
  add_action('admin_init', 's2member_eot_warning_admin_init');
}

function s2member_eot_warning_options_page() {
  echo '<div class="wrap">';
  echo '<h2>s2member EOT Warning</h2>';
  echo 'Options relating to the s2member EOT Warning Plugin.';
  echo '<form action="options.php" method="post">';
  settings_fields('s2member_eot_warning_options');
  do_settings_sections('s2member_eot_warning');
  echo '<p class="submit">';
  echo '<input type="submit" class="button-primary" value="' . esc_attr('Save Changes') . '" />';
  echo '</p>';
  echo '</form>';
  echo '</div>';
}

function s2member_eot_warning_admin_init() {
  register_setting('s2member_eot_warning_options', 's2member_eot_warning_options');
  add_settings_section('s2member_eot_warning_main', 'Main Settings', 's2member_eot_warning_main_text', 's2member_eot_warning');
  add_settings_field('s2member_eot_warning_interval', 'Interval', 's2member_eot_warning_interval', 's2member_eot_warning', 's2member_eot_warning_main');
  add_settings_field('s2member_eot_warning_message', 'Message', 's2member_eot_warning_message', 's2member_eot_warning', 's2member_eot_warning_main');
}

function s2member_eot_warning_main_text() {
}

function s2member_eot_warning_interval() {
  $options = get_option('s2member_eot_warning_options');
  echo '<input id="s2member_eot_warning_interval" name="s2member_eot_warning_options[interval]" size="40" type="text" value="' . $options['interval'] . '" />';
}

function s2member_eot_warning_message() {
  $options = get_option('s2member_eot_warning_options');
  echo '<textarea id="s2member_eot_warning_message" name="s2member_eot_warning_options[message]" cols="70" rows="8">' . $options['message'] . '</textarea>';
}

// Default options set on activation and deactivation
function set_s2member_eot_warning_options() {
  add_option('s2member_eot_warning_options', array('interval' => '2 weeks', 'message' => 'Default Template'));
}

function unset_s2member_eot_warning_options() {
  delete_option('s2member_eot_warning_options');
}

register_activation_hook(__FILE__, 'set_s2member_eot_warning_options');
unregister_activation_hook(__FILE__, 'unset_s2member_eot_warning_options');
?>
