<?php
/*
Plugin Name: Divine Drip API integration
Description: connect to drip API
Author: Native-Code
Developer: Eyal Ron
Author URI: https://native-code.com
Text Domain: Native-Code
version: 1.0
*/

//plugin code



/**
 * settings page setup for this plugin
 */
add_action('admin_menu', function() {
    add_options_page( 'divine drip api itegration plugin settings', 'Divine drip api itegration', 'manage_options', 'ddi-plugin', 'ddi_plugin_page' );
});
add_action( 'admin_init', function() {
    register_setting( 'ddi-plugin-settings', 'drip_api_token' );
});
function ddi_plugin_page() {
  ?>
    <div class="wrap">
      <div style="display:flex;align-items:baseline;">
        <h1 style="margin-right:8px;">Divine Drip Integration Settings</h1>
        <span>by <a target="_blank" href="https://divinesites.co.il">Divine Sites</a></span>
      </div>
      <form action="options.php" method="post">
        <?php
          settings_fields( 'ddi-plugin-settings' );
          do_settings_sections( 'ddi-plugin-settings' );
        ?>
        <h3>Drip Settings</h3>
        <table>
            <tr>
              <th>Drip API Token</th>
              <td>
                <input type="text" placeholder="" name="drip_api_token" value="<?php echo esc_attr( get_option('drip_api_token') ); ?>" size="40" />
              </td>
            </tr>
            <tr>
                <td><?php submit_button(); ?></td>
            </tr>
        </table>
      </form>
    </div>
  <?php
}
?>
