<?php
/*
Plugin Name: Divine form validation
Description: forms words count and validation
Author: Eyal Ron
version: 1.0
*/

add_action('wp_enqueue_scripts','form_validation_init');

function form_validation_init() {
    wp_enqueue_script( 'form-validation-js', plugins_url( '/inc/form_validation.js', __FILE__ ));
    wp_enqueue_style( 'style1', plugins_url( '/inc/form_validation.css', __FILE__ ) );
}

/**
 * sttings page setup for the plugin
 */
add_action('admin_menu', function() {
    add_options_page( 'divine forms validation plugin settings', 'Divine Forms Validation', 'manage_options', 'dfv-plugin', 'dfv_plugin_page' );
});
add_action( 'admin_init', function() {
    register_setting( 'dfv-plugin-settings', 'very_bad_color' );
    register_setting( 'dfv-plugin-settings', 'bad_color' );
    register_setting( 'dfv-plugin-settings', 'mid_color' );
    register_setting( 'dfv-plugin-settings', 'good_color' );
    register_setting( 'dfv-plugin-settings', 'perfect_color' );
});
function dfv_plugin_page() {
  ?>
    <div class="wrap">
      <h1>Divine Forms Validation Settings</h1>
      <form action="options.php" method="post">

        <?php
          settings_fields( 'dfv-plugin-settings' );
          do_settings_sections( 'dfv-plugin-settings' );
        ?>
        <h3>Set color codes for the counter graph</h3>
        <table>
            <tr>
              <th>Very bad color code</th>
              <td>
                <input type="text" placeholder="" name="very_bad_color" value="<?php echo esc_attr( get_option('very_bad_color') ); ?>" size="20" />
                <div style="width:15%; border:2px solid <?php echo esc_attr( get_option('very_bad_color') ); ?>" class="graph"></div>
              </td>
            </tr>
            <tr>
                <th>Bad color code</th>
                <td>
                  <input type="text" placeholder="" name="bad_color" value="<?php echo esc_attr( get_option('bad_color') ); ?>" size="20" />
                  <div style="width:35%; border:2px solid <?php echo esc_attr( get_option('bad_color') ); ?>" class="graph"></div>
                </td>
            </tr>
            <tr>
              <th>mid color code</th>
                <td>
                  <input type="text" placeholder="" name="mid_color" value="<?php echo esc_attr( get_option('mid_color') ); ?>" size="20" />
                  <div style="width:55%; border:2px solid <?php echo esc_attr( get_option('mid_color') ); ?>" class="graph"></div>
                </td>
            </tr>
            <tr>
                <th>good color code</th>
                <td>
                  <input type="text" placeholder="" name="good_color" value="<?php echo esc_attr( get_option('good_color') ); ?>" size="20" />
                  <div style="width:75%; border:2px solid <?php echo esc_attr( get_option('good_color') ); ?>" class="graph"></div>
                </td>
            </tr>
            <tr>
                <th>perfect color code</th>
                <td>
                  <input type="text" placeholder="" name="perfect_color" value="<?php echo esc_attr( get_option('perfect_color') ); ?>" size="20" />
                  <div style="width:97%; border:2px solid <?php echo esc_attr( get_option('perfect_color') ); ?>" class="graph"></div>
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
// add styles from the settings page to the dom
$custom_styles = '
  .counterGraph {
      border-color: '.esc_attr( get_option('very_bad_color') ).';
  }
  .counterGraph.badCount {
      border-color: '.esc_attr( get_option('bad_color') ).';
  }
  .counterGraph.midCount {
      border-color: '.esc_attr( get_option('mid_color') ).';
  }
  .counterGraph.goodCount {
      border-color: '.esc_attr( get_option('good_color') ).';
  }
  .counterGraph.perfectCount {
      border-color: '.esc_attr( get_option('perfect_color') ).';
  }';
wp_register_style( 'dfv-options-css', false );
wp_enqueue_style( 'dfv-options-css' );
wp_add_inline_style( 'dfv-options-css', $custom_styles );
