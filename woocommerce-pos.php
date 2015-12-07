<?php

/**
 * Plugin Name:       WooCommerce POS - Esmeer Fork
 * Description:       A simple front-end for taking WooCommerce orders at the Point of Sale. Requires <a href="http://wordpress.org/plugins/woocommerce/">WooCommerce</a>.
 * Version:           0.4.5
 * Author:            Esmeer
 * Author URI:        http://www.esmeer.com
 * Text Domain:       woocommerce-pos
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 *
 * @package   WooCommerce POS
 * @author    Esmeer
 * @link      http://www.esmeer.com
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/**
 * Define plugin constants.
 */
define( 'WC_POS_VERSION', '0.4.5' );
define( 'WC_POS_PLUGIN_NAME', 'woocommerce-pos' );
define( 'WC_POS_PLUGIN_FILE', plugin_basename( __FILE__ ) ); // 'woocommerce-pos/woocommerce-pos.php'
define( 'WC_POS_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'WC_POS_PLUGIN_URL', trailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );

/**
 * The code that runs during plugin activation.
 */
require_once WC_POS_PLUGIN_PATH . 'includes/class-wc-pos-activator.php';
new WC_POS_Activator( plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin deactivation.
 */
require_once WC_POS_PLUGIN_PATH . 'includes/class-wc-pos-deactivator.php';
new WC_POS_Deactivator( plugin_basename( __FILE__ ) );

require_once WC_POS_PLUGIN_PATH . 'includes/wc-pos-esmeer.php';
function default_product_category($post_ID) {
	$store_name = verify();
	if ($store_name != 1 && (get_post_type($post_ID) == 'product')){
		$term_ids = get_terms('product_cat',array('fields' => 'ids', 'search' => $store_name));
		$term = get_term_by( 'id', $term_ids[0], 'product_cat');
		$taxonomy = 'product_cat';
		wp_set_object_terms( $post_ID, (int) $term_ids[0], $taxonomy );
	}  
}

add_action( 'save_post', 'default_product_category' );