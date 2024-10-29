<?php
/*
Plugin Name: azurecurve Shortcodes In Widgets
Plugin URI: http://development.azurecurve.co.uk/plugins/shortcodes-in-widgets

Description: Allows shortcodes to be used in widgets.
Version: 2.0.2

Author: azurecurve
Author URI: http://development.azurecurve.co.uk

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.


The full copy of the GNU General Public License is available here: http://www.gnu.org/licenses/gpl.txt

*/

//include menu
require_once( dirname(  __FILE__ ) . '/includes/menu.php');

add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );


// azurecurve menu
function azc_create_siw_plugin_menu() {
	global $admin_page_hooks;
    
	add_submenu_page( "azc-plugin-menus"
						,"Shortcodes in Widgets"
						,"Shortcodes in Widgets"
						,'manage_options'
						,"azc-siw"
						,"azc_siw_settings" );
}
add_action("admin_menu", "azc_create_siw_plugin_menu");

function azc_siw_settings() {
	if (!current_user_can('manage_options')) {
		$error = new WP_Error('not_found', __('You do not have sufficient permissions to access this page.' , 'azc_siw'), array('response' => '200'));
		if(is_wp_error($error)){
			wp_die($error, '', $error->get_error_data());
		}
    }
	?>
	<div id="azc-t-general" class="wrap">
			<h2>azurecurve Shortcodes in Widgets</h2>
			<p>
				<?php _e('This plugin allows shortcodes to be used in widgets.', 'azc_siw'); ?>
			</p>
			<p>
				azurecurve <?php _e('has a sister plugin to this one which allows shortcodes to be used in comments:', 'azc_md'); ?>
				<ul class='azc_plugin_index'>
					<li>
						<?php
						if ( is_plugin_active( 'azurecurve-shortcodes-in-comments/azurecurve-shortcodes-in-comments.php' ) ) {
							echo "<a href='admin.php?page=azc-sic' class='azc_plugin_index'>Shortcodes in Comments</a>";
						}else{
							echo "<a href='https://wordpress.org/plugins/azurecurve-shortcodes-in-comments/' class='azc_plugin_index'>Shortcodes in Comments</a>";
						}
						?>
					</li>
				</ul>
			</p>
	</div>
	
<?php
}

?>