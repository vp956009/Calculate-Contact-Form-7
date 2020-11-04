<?php
/**
* Plugin Name: Cost Calculator Contact Form 7
* Description: This plugin allows create cost calculator and slider for contact form 7.
* Version: 1.0
* Copyright: 2019 
*/

if (!defined('ABSPATH')) {
   	die('-1');
}
if (!defined('CF7COSTCALOC_PLUGIN_NAME')) {
   	define('CF7COSTCALOC_PLUGIN_NAME', 'Cost Calculator Contact Form 7');
}
if (!defined('CF7COSTCALOC_PLUGIN_VERSION')) {
   	define('CF7COSTCALOC_PLUGIN_VERSION', '1.0.0');
}
if (!defined('CF7COSTCALOC_PLUGIN_FILE')) {
   	define('CF7COSTCALOC_PLUGIN_FILE', __FILE__);
}
if (!defined('CF7COSTCALOC_PLUGIN_DIR')) {
   	define('CF7COSTCALOC_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('CF7COSTCALOC_BASE_NAME')) {
    define('CF7COSTCALOC_BASE_NAME', plugin_basename(CF7COSTCALOC_PLUGIN_FILE));
}
if (!defined('CF7COSTCALOC_DOMAIN')) {
   	define('CF7COSTCALOC_DOMAIN', 'cf7costcaloc');
}
if (!defined('DEBUG')) {
    define('DEBUG', 0);
}
if (!defined('CF7COSTCALOCPREFIX')) {
    define('CF7COSTCALOCPREFIX', "cf7costcaloc_");
}
if (!defined('PAGE_SLUG')) {
    define('PAGE_SLUG', "cf7costcaloc_paypal_entries");
}



if (!class_exists('CF7COSTCALOC')) {
   	add_action('plugins_loaded', array('CF7COSTCALOC', 'CF7COSTCALOC_instance'));
   	class CF7COSTCALOC {

      	protected static $CF7COSTCALOC_instance; 

      	public static function CF7COSTCALOC_instance() {
         	if (!isset(self::$CF7COSTCALOC_instance)) {
            	self::$CF7COSTCALOC_instance = new self();
            	self::$CF7COSTCALOC_instance->init();
            	self::$CF7COSTCALOC_instance->includes();
         	}
        	return self::$CF7COSTCALOC_instance;
      	}

      	function includes() {
         	include_once('admin/calculator.php');
         	include_once('admin/rangeslider.php');
         	include_once('admin/cf7costcaloc-backend.php');     
            include_once('admin/cf7costcaloc-export-csv.php'); 
            include_once('admin/cf7costcaloc-cf7-panel.php');
      	}


      	function init() {
         	add_action( 'admin_init', array($this, 'CF7COSTCALOC_load_plugin'), 11 );
         	add_action( 'admin_enqueue_scripts', array($this, 'CF7COSTCALOC_load_admin_script_style'));
         	add_action( 'wp_enqueue_scripts',  array($this, 'CF7COSTCALOC_load_script_style'));
         	add_filter( 'plugin_row_meta', array( $this, 'CF7COSTCALOC_plugin_row_meta' ), 10, 2 );
         	add_filter( 'admin_footer', array( $this, 'CF7COSTCALOC_css_admin' ), 10, 2 );


         	session_start();
            global $wpdb;
            $table_name = $wpdb->prefix.'cf7costcaloc_forms';
            if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {

                $charset_collate = $wpdb->get_charset_collate();

                $sql = "CREATE TABLE $table_name (
                    form_id bigint(20) NOT NULL AUTO_INCREMENT,
                    form_post_id bigint(20) NOT NULL,
                    form_value longtext NOT NULL,
                    form_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                    PRIMARY KEY  (form_id)
                ) $charset_collate;";

                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                dbDelta( $sql );
            }

            $upload_dir      = wp_upload_dir();
            $cf7costcaloc_dirname = $upload_dir['basedir'].'/cf7costcaloc_uploads';
            if ( ! file_exists( $cf7costcaloc_dirname ) ) {
                wp_mkdir_p( $cf7costcaloc_dirname );
            }
      	}


      	function CF7COSTCALOC_load_plugin() {
         	if ( ! ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) ) {
            	add_action( 'admin_notices', array($this,'CF7COSTCALOC_install_error') );
         	}
      	}


	    function CF7COSTCALOC_install_error() {
	        deactivate_plugins( plugin_basename( __FILE__ ) );
        	?>
         		<div class="error">
            		<p>
               			<?php _e( ' cf7 calculator plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=contact+form+7">Contact Form 7</a> plugin installed and activated.', CF7COSTCALOC_DOMAIN ); ?>
            		</p>
         		</div>
        	<?php
      	}


      	function CF7COSTCALOC_load_admin_script_style() {
            wp_enqueue_style( 'CF7COSTCALOC-back-style', CF7COSTCALOC_PLUGIN_DIR . '/includes/css/back_style.css', false, '1.0.0' );
            wp_enqueue_script( 'CF7COSTCALOC-back-script', CF7COSTCALOC_PLUGIN_DIR . '/includes/js/back_script.js', false, '1.0.0' );
        }


      	function CF7COSTCALOC_load_script_style() {
         	wp_enqueue_script( 'CF7COSTCALOC-front-js', CF7COSTCALOC_PLUGIN_DIR . '/includes/js/front.js', false, '2.0.0' );

        	wp_enqueue_script( 'jquery-ui' );
         	wp_enqueue_script( 'jquery-ui-slider' );
         	wp_enqueue_script( 'jquery-touch-punch' );
 

         	wp_enqueue_style( 'CF7COSTCALOC-front-jquery-ui-css', CF7COSTCALOC_PLUGIN_DIR . '/includes/js/jquery-ui.css', false, '2.0.0' );
         	wp_enqueue_style( 'CF7COSTCALOC-front-css', CF7COSTCALOC_PLUGIN_DIR . '/includes/css/front-style.css', false, '2.0.0' );
      	}


      	function CF7COSTCALOC_plugin_row_meta( $links, $file ) {
         	if ( CF7COSTCALOC_BASE_NAME === $file ) {
             	$row_meta = array(
                 	'rating'    =>  '<a href="#" target="_blank"><img src="'.CF7COSTCALOC_PLUGIN_DIR.'/includes/images/star.png" class="costcf7oc_rating_div"></a>',
             	);
             	return array_merge( $links, $row_meta );
         	}
         	return (array) $links;
      	} 


      	function CF7COSTCALOC_css_admin() {
         	?>
         		<style type="text/css">
		            .costcf7oc_rating_div {
		               width: 10%;
		               vertical-align: middle;
		            }
         		</style>
         	<?php
      	}
   	}  
}
