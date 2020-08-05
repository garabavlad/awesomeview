<?php
/*
Plugin Name: Mailtrap for WordPress
Plugin URI: http://eduardomarcolino.com/plugins/mailtrap-for-wordpress
Description: Easily configure wordpress to send emails to Mailtrap.io
Version: 0.3
Author: Eduardo Marcolino
Author URI: http://eduardomarcolino.com
Text Domain: mailtrap-for-wp
Domain Path: /languages
License: GPL v2
GitHub Plugin URI: https://github.com/eduardo-marcolino/mailtrap-for-wordpress

Mailtrap for WordPress
Copyright (C) 2015, Eduardo Marcolino, eduardo.marcolino@gmail.com
 
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if( ! defined( 'ABSPATH' ) ) {
  exit;
}

if ( ! class_exists( 'MailtrapPlugin' ) ) :
  
final class MailtrapPlugin {
  
  public 
    $plugin_url,
    $plugin_path
  ;
  
  public static function init() 
  {
    $plugin = new MailtrapPlugin();
    $plugin->plugin_setup(); 
  }
  
  public function plugin_setup() 
  {
    $this->plugin_url    = plugins_url( '/', __FILE__ );
    $this->plugin_path   = plugin_dir_path( __FILE__ );
    
    add_action( 'phpmailer_init', array($this, 'mailer_setup' ) );
    add_action( 'admin_menu', array($this, 'menu_setup' ) );  
    add_action( 'admin_init', array($this, 'register_settings') );
    load_plugin_textdomain( 'mailtrap-for-wp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
  }
  
  public function menu_setup() {
    add_options_page( 'Mailtrap for Wordpress', 'Mailtrap', 'manage_options', 'mailtrap-settings', array($this, 'settings_page' ) );
    add_submenu_page( null, 'Mailtrap for Wordpress', 'Mailtrap Test', 'manage_options', 'mailtrap-test', array($this, 'test_page' ));
  }
  
  public function settings_page() {
    include $this->plugin_path.'/includes/settings.php';
  }
  
  public function test_page() 
  {    
    $email_sent = null;
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
      if (!wp_verify_nonce( $_POST['_wpnonce'], 'mailtrap_test_action' ) ) {
        die( 'Failed security check' );
      }
      
      $email_sent = wp_mail( $_POST['to'], __( 'Mailtrap for Wordpress Plugin', 'mailtrap-for-wp' ), $_POST['message']);
    }
      
    include $this->plugin_path.'/includes/test.php';
  }
  
  public function sample_admin_notice__success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Done!', 'sample-text-domain' ); ?></p>
    </div>
    <?php
  }

  public function register_settings() 
  {
    register_setting( 'mailtrap-settings', 'mailtrap_enabled' );
    register_setting( 'mailtrap-settings', 'mailtrap_port' );
    register_setting( 'mailtrap-settings', 'mailtrap_username' );
    register_setting( 'mailtrap-settings', 'mailtrap_password' );
    register_setting( 'mailtrap-settings', 'mailtrap_secure' );
    register_setting( 'mailtrap-settings', 'mailtrap_api_token' );
  }
  
  public function mailer_setup(PHPMailer $phpmailer) 
  {
    if(get_option('mailtrap_enabled', false))
    {
      $phpmailer->IsSMTP();
      $phpmailer->Host = 'smtp.mailtrap.io';
      $phpmailer->SMTPAuth = true;
      $phpmailer->Port = get_option('mailtrap_port');
      $phpmailer->Username = get_option('mailtrap_username');
      $phpmailer->Password = get_option('mailtrap_password');
      $phpmailer->SMTPSecure = get_option('mailtrap_secure');
    }
  }
}

add_action( 'plugins_loaded', array( 'MailtrapPlugin', 'init' ) );

endif;
